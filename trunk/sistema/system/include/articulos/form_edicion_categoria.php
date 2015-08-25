<?php
    $registro = array('', '', '', '');
    
    if (isset($_REQUEST["codigo"])) {
        $query = "SELECT * FROM categorias WHERE codigo = ".$_REQUEST["codigo"];
        $result = mysql_query($query);
        $registro = mysql_fetch_row($result);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $query = "SELECT MAX(codigo) + 1 FROM categorias";
            $result = mysql_query($query);
            $registro[0] = mysql_result($result, 0, 0);
        }
    }
    
    $action = 'edicion_categoria';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_categoria';
    }
    
    include_once('include/imagen.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/boton.php');
    include_once('include/articulos/categorias.php');
    
    $campo_cod_orig = new CampoOculto('codigo-original', $registro[0]);
    $campo_include = new CampoOculto('include', 'articulos');
    $campo_action = new CampoOculto('action', $action);
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_cat = new CampoCombo('padre', 'Categoría superior:');
    $campo_img = new Campo('imagen', $registro[3], 'Archivo de imagen:', 'file');
    $boton = new Boton('aceptar', 'Aceptar');
    $imagen = new Imagen($registro[3]);
    
    $categorias = new Categorias();
    $campo_cat->add_option('NO TIENE');
    $campo_cat->set_sql_options($categorias->get_categorias());
    $campo_cat->set_selected_option($registro[2]);
?>    

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Alta de categoría";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n de categoría";
        }
        else {
            print "Edici&oacute;n de categoría";
        }
    }
    else {
        print "Edici&oacute;n de categoría";
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
            $campo_cat->show();
            $campo_img->show();
        ?>
        <p>&nbsp;</p>
        <?php
            $boton->show();
        ?>
    </div>
</form>
