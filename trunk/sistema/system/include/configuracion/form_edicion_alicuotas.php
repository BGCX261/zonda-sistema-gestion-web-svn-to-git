<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/alicuotas.php');
    
    $alicuotas = new Alicuotas();
    
    $registro = array('', '', '0');
    
    if (isset($_REQUEST["codigo"])) {
        $registro = $alicuotas->get_row($_REQUEST["codigo"]);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $registro[0] = $alicuotas->current_id() + 1;
        }
    }
    
    $action = 'edicion_alicuota';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_alicuota';
    }
    
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_decimal.php');
    include_once('include/boton.php');
    
    $form = new Formulario();
    $form->set_param('action', $action);
    $form->set_param('codigo-original', $registro[0]);
    $form->set_param('include', 'configuracion');
    $form->set_param('form', 'listado_alicuotas');
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_cod->set_required();
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_des->set_required();
    $campo_ali = new CampoDecimal('alicuota', $registro[2], 'Alícuota (en porcentaje):');
    $campo_ali->set_required();
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
?> de alícuota</h1>

<?php
    $form->open();
?>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_cod->show();
        $campo_des->show();
        $campo_ali->show();
    ?>
    <p></p>
    <?php
        $boton->show();
    ?>
</div>
<?php
    $form->close();
?>