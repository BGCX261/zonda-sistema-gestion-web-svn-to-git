<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $condiciones = new CondicionesVenta();
    
    $registro = array('0', '', '0', '0', 'DIA', '0');
    
    if (isset($_REQUEST["codigo"])) {
        $registro = $condiciones->get_row($_REQUEST["codigo"]);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $registro[0] = $condiciones->current_id() + 1;
        }
    }
    
    $action = 'edicion_condicion';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_condicion';
    }
    
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/campo_entero.php');
    include_once('include/campo_decimal.php');
    include_once('include/boton.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $form = new Formulario();
    $form->set_param('action', $action);
    $form->set_param('codigo-original', $registro[0]);
    $form->set_param('include', 'configuracion');
    $form->set_param('form', 'listado_condiciones_venta');
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_cod->set_required();
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_des->set_required();
    $campo_cuotas = new CampoEntero('cuotas', $registro[2], 'Cuotas:');
    $campo_cuotas->set_required();
    $campo_plazo = new CampoEntero('plazo', $registro[3], 'Plazo de vencimiento:');
    $campo_plazo->set_required();
    $campo_interv = new CampoCombo('intervalo', 'Intervalo:');
    $campo_interv->set_required();
    $campo_interv->add_option('Seleccione un intervalo...');
    $campo_interv->add_option('Días', 'DIA');
    $campo_interv->add_option('Meses', 'MES');
    $campo_interv->add_option('Años', 'AÑO');
    $campo_interv->set_selected_option($registro[4]);
    $campo_int = new CampoDecimal('interes', $registro[5], 'Interés (en %):');
    $campo_int->set_required();
    $boton = new Boton('aceptar', 'Aceptar');
?>

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Alta";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n";
        }
        else {
            print "Edici&oacute;n";
        }
    }
    else {
        print "Edici&oacute;n";
    }
?> de condición de venta</h1>

<?php
    $form->open();
?>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_cod->show();
        $campo_des->show();
        $campo_cuotas->show();
        $campo_plazo->show();
        $campo_interv->show();
        $campo_int->show();
    ?>
    <p></p>
    <?php
        $boton->show();
    ?>
</div>
<?php
    $form->close();
?>