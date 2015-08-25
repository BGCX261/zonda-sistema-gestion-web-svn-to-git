<?php
    $registro = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    
    if (isset($_REQUEST["codigo"])) {
        $query = "SELECT * FROM clientes WHERE codigo = ".$_REQUEST["codigo"];
        $result = mysql_query($query);
        $registro = mysql_fetch_row($result);
    }
    
    $action = 'edicion';
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $query = "SELECT MAX(codigo) + 1 FROM clientes";
            $result = mysql_query($query);
            $registro[0] = mysql_result($result, 0, 0);
        }
        $action = $_REQUEST['type'];
    }
    
    include_once('include/formulario.php');
    include_once('include/imagen.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/campo_texto.php');
    include_once('include/boton.php');
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/localidades.php');
    include_once('include/articulos/listas_precios.php');
    include_once('include/url_util.php');
    
    $formulario = new Formulario();
    $url = new UrlUtil();
    $formulario->set_action_uri($url->get_uri());
    $campo_codigo_orig = new CampoOculto('codigo-original', $registro[0]);
    $campo_include = new CampoOculto('include', 'clientes');
    $campo_action = new CampoOculto('action', $action);
    $campo_codigo = new CampoCodigo('codigo', $registro[0]);
    $campo_razon = new Campo('razon', $registro[1], 'Razón social:', 'text');
    $campo_cuit = new Campo('cuit', $registro[2], 'CUIT:', 'text');
    $campo_nombre = new Campo('nombre', $registro[3], 'Nombre:', 'text');
    $campo_domicilio = new Campo('domicilio', $registro[4], 'Domicilio:', 'text');
    $campo_telefono = new Campo('telefono', $registro[5], 'Teléfono:', 'text');
    $campo_provincia = new CampoCombo('provincia', 'Provincia:');
    $campo_localidad = new CampoCombo('localidad', 'Localidad:');
    $campo_cp = new Campo('cp', $registro[8], 'Código Postal:', 'text');
    $campo_contacto = new Campo('contacto', $registro[9], 'Contacto:', 'text');
    $campo_pagina = new Campo('pagina', $registro[10], 'Página:', 'text');
    $campo_correo = new Campo('correo', $registro[11], 'Correo:', 'text');
    $campo_saldo = new Campo('saldo', $registro[12], 'Saldo:', 'text');
    $campo_total = new Campo('total', $registro[13], 'Total:', 'text');
    $campo_lista = new CampoCombo('lista', 'Lista de precios:');
    $campo_imagen = new Campo('imagen', $registro[17], 'Archivo de imagen:', 'file');
    $boton = new Boton('aceptar', 'Guardar cambios');
    $imagen = new Imagen($registro[17]);
    
    $provincias = new Provincias();
    $campo_provincia->add_option('Seleccione una provincia...');
    $campo_provincia->set_sql_options($provincias->get_provincias());
    $campo_provincia->set_selected_option($registro[6]);
    
    if (!empty($registro[6])) {
        $localidades = new Localidades($registro[6]);
        $campo_localidad->set_sql_options($localidades->get_localidades());
        $campo_localidad->set_selected_option($registro[7]);
    }
    else {
        $campo_localidad->add_option('Seleccione una ciudad...');
    }
    
    $listas = new ListasPrecios();
    $campo_lista->set_sql_options($listas->get_listas());
    $campo_lista->set_selected_option($registro[14]);
?>

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Alta de cliente";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n de cliente";
        }
        else {
            print "Edici&oacute;n de cliente";
        }
    }
    else {
        print "Edici&oacute;n de cliente";
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
        $campo_razon->show();
        $campo_cuit->show();
        $campo_nombre->show();
        $campo_domicilio->show();
        $campo_telefono->show();
        $campo_provincia->show();
        $campo_localidad->show();
        $campo_cp->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_contacto->show();
        $campo_pagina->show();
        $campo_correo->show();
        $campo_lista->show();
        $campo_imagen->show();
    ?>
    <p>&nbsp;</p>
    <?php
        $boton->show();
    ?>
</div>
<?php
    $formulario->close();
?>