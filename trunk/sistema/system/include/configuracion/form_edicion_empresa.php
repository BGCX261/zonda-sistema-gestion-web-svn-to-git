<?php

    include_once('include/formulario.php');
    include_once('include/imagen.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_combo.php');
    include_once('include/boton.php');
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/localidades.php');
    
    $registro = mysql_fetch_array(mysql_query("SELECT * FROM empresa"));
    
    print '<h1>Editar la información de la empresa</h1>';
    
    $formulario = new Formulario();
    $formulario->set_action_uri('?include=configuracion&form=form_edicion_empresa&action=edicion_empresa');
    
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
    $campo_imagen = new Campo('imagen', $registro[12], 'Archivo de imagen:', 'file');
    
    $boton = new Boton('aceptar', 'Guardar cambios');
    
    $imagen = new Imagen($registro[12]);
    
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
    
?>
<p id="mensaje-error">Complete los campos para continuar</p>

<?php
    $formulario->open();
?>
<div class="grupo-campos grupo-campos-mediano">
    <label>Imagen:</label>
    <?php $imagen->show(); ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_razon->show();
        $campo_cuit->show();
        $campo_nombre->show();
        $campo_domicilio->show();
        $campo_telefono->show();
        $campo_contacto->show();
        $campo_pagina->show();
        $campo_correo->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_provincia->show();
        $campo_localidad->show();
        $campo_cp->show();
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