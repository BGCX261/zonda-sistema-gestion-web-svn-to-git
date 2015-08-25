<?php
    include_once('include/configuracion/provincias.php');
    
    $provincias = new Provincias();
    
    $registro = array('', '');
    
    if (isset($_REQUEST["codigo"])) {
        $registro = $provincias->get_provincia($_REQUEST["codigo"]);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $registro[0] = $provincias->current_id() + 1;
        }
    }
    
    $action = 'edicion_provincia';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_provincia';
    }
    
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/boton.php');
    
    $form = new Formulario();
    $form->set_param('action', $action);
    $form->set_param('codigo-original', $registro[0]);
    $form->set_param('include', 'configuracion');
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_cod->set_required();
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
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
?> de provincia</h1>

<?php
    $form->open();
?>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_cod->show();
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