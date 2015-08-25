<?php
    $registro = array('', '', '', '', '', '', '', '', '', '', '');
    
    if (isset($_REQUEST["codigo"])) {
        $query = "SELECT * FROM articulos WHERE codigo = ".$_REQUEST["codigo"];
        $result = mysql_query($query);
        $registro = mysql_fetch_row($result);
    }
    
    $action = 'edicion';
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $query = "SELECT MAX(codigo) + 1 FROM articulos";
            $result = mysql_query($query);
            $registro[0] = mysql_result($result, 0, 0);
        }
        $action = $_REQUEST['type'];
    }
    
    include_once('include/table_handler.php');
    include_once('include/formulario.php');
    include_once('include/imagen.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/campo_texto.php');
    include_once('include/boton.php');
    include_once('include/articulos/categorias.php');
    include_once('include/proveedores/proveedores.php');
    include_once('include/articulos/marcas.php');
    include_once('include/configuracion/alicuotas.php');
    include_once('include/url_util.php');
    
    $formulario = new Formulario();
    $url = new UrlUtil();
    $formulario->set_action($url->get_uri());
    $campo_codigo_orig = new CampoOculto('codigo-original', $registro[0]);
    $campo_include = new CampoOculto('include', 'articulos');
    $campo_action = new CampoOculto('action', $action);
    $campo_codigo = new CampoCodigo('codigo', $registro[0]);
    $campo_descripcion = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_categoria = new CampoCombo('categoria', 'Categoría:');
    $campo_proveedor = new CampoCombo('proveedor', 'Proveedor:');
    $campo_marca = new CampoCombo('marca', 'Marca:');
    $campo_costo = new Campo('costo', $registro[5], 'Costo:', 'text');
    $campo_precio = new Campo('precio', $registro[6], 'Precio de referencia:', 'text');
    $campo_alicuota = new CampoCombo('alicuota', 'Alícuota:');
    $campo_imagen = new Campo('imagen', $registro[9], 'Archivo de imagen:', 'file');
    $campo_resumen = new CampoTexto('resumen', 'Resumen:');
    $campo_resumen->set_text($registro[10]);
    $boton = new Boton('aceptar', 'Guardar cambios');
    $imagen = new Imagen($registro[9]);
    
    $categorias = new Categorias();
    $campo_categoria->set_sql_options($categorias->get_categorias());
    $campo_categoria->set_selected_option($registro[2]);
    
    $proveedores = new Proveedores();
    $campo_proveedor->set_sql_options($proveedores->get_result());
    $campo_proveedor->set_selected_option($registro[3]);
    
    $marcas = new Marcas();
    $campo_marca->set_sql_options($marcas->get_marcas());
    $campo_marca->set_selected_option($registro[4]);
    
    $alicuotas = new Alicuotas();
    $campo_alicuota->set_sql_options($alicuotas->get_result());
    $campo_alicuota->set_selected_option($registro[7]);
?>

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Alta de artículo";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n de artículo";
        }
        else {
            print "Edici&oacute;n de artículo";
        }
    }
    else {
        print "Edici&oacute;n de artículo";
    }
?></h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<?php
    $formulario->open();
    $campo_include->show();
    $campo_action->show();
?>
<div class="grupo-campos grupo-campos-mediano">
    <label>Imagen:</label>
    <?php $imagen->show(); ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_codigo_orig->show();
        $campo_codigo->show();
        $campo_descripcion->show();
        $campo_categoria->show();
        $campo_proveedor->show();
        $campo_marca->show();
        $campo_costo->show();
        $campo_precio->show();
        $campo_alicuota->show();
        $campo_imagen->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_resumen->show();
        $boton->show();
    ?>
</div>
<?php
    $formulario->close();
?>