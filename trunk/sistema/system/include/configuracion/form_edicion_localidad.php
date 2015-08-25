<?php
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/localidades.php');
    
    $provincias = new Provincias();
    $localidades = new Localidades(0);
    
    $registro = array('', '', '', '');
    
    if (isset($_REQUEST["codigo"])) {
        $registro = $localidades->get_localidad($_REQUEST["codigo"]);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $registro[0] = $localidades->current_id() + 1;
        }
    }
    
    $action = 'edicion_localidad';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_localidad';
    }
    
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/boton.php');
    include_once('include/configuracion/provincias.php');
    
    $form = new Formulario();
    $form->set_param('action', $action);
    $form->set_param('codigo-original', $registro[0]);
    $form->set_param('include', 'configuracion');
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_cod->set_required();
    $campo_prov = new CampoCombo('provincia', 'Provincia:');
    $campo_prov->set_required();
    $campo_prov->add_option('Seleccione una provincia...');
    $campo_prov->set_sql_options($provincias->get_provincias());
    $campo_prov->set_selected_option($registro[1]);
    $campo_des = new Campo('descripcion', $registro[2], 'Descripción:', 'text');
    $campo_des->set_required();
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
?> de localidad</h1>

<?php
    $form->open();
?>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_cod->show();
        $campo_prov->show();
        $campo_des->show();
    ?>
    <p></p>
    <?php
        $boton->show();
    ?>
</div>
<?php
    $form->close();
?>