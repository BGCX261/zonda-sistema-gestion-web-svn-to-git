<?php
    $registro = array('', '', '', '');
    
    if (isset($_REQUEST["codigo"])) {
        $query = "SELECT * FROM marcas WHERE codigo = ".$_REQUEST["codigo"];
        $result = mysql_query($query);
        $registro = mysql_fetch_row($result);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $query = "SELECT MAX(codigo) + 1 FROM marcas";
            $result = mysql_query($query);
            $registro[0] = mysql_result($result, 0, 0);
        }
    }
    
    $action = 'edicion_marca';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_marca';
    }
    
    include_once('include/imagen.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/boton.php');
    
    $campo_cod_orig = new CampoOculto('codigo-original', $registro[0]);
    $campo_include = new CampoOculto('include', 'articulos');
    $campo_action = new CampoOculto('action', $action);
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_img = new Campo('imagen', $registro[2], 'Archivo de imagen:', 'file');
    $boton = new Boton('aceptar', 'Aceptar');
    $imagen = new Imagen($registro[2]);
?>

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Alta de marca";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n de marca";
        }
        else {
            print "Edici&oacute;n de marca";
        }
    }
    else {
        print "Edici&oacute;n de marca";
    }
?></h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="POST" enctype="multipart/form-data">
    <?php 
        $campo_include->show();
        $campo_action->show();
        $campo_cod_orig->show();
    ?>
    <div class="grupo-campos grupo-campos-mediano">
        <?php
            $imagen->show();
        ?>
    </div>
    <div class="grupo-campos grupo-campos-mediano">
        <?php 
            $campo_cod->show();
            $campo_des->show();
            $campo_img->show();
        ?>
        <p>&nbsp;</p>
        <?php
            $boton->show();
        ?>
    </div>
</form>