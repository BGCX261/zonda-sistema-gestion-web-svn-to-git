<?php
    include_once('../table_handler.php');
    include_once('../conexion.php');
    include_once('proveedores.php');
    include_once('../configuracion/provincias.php');
    include_once('../configuracion/localidades.php');
    Conexion::conectar();
    $proveedores = new Proveedores();
    $provincias = new Provincias();
    $localidades = new Localidades(0);
    $registro = $proveedores->get_row($_REQUEST['codigo']);
?>
<div class="grupo-campos grupo-campos-chico">
    <img class="imagen imagen-chica" src="<?php empty($registro[14]) ? print 'images/sin-imagen.png' : print $registro[14]; ?>" />
</div>
<div class="grupo-campos grupo-campos-mediano">
    <p class="contenido-campo"><?php print $registro[0]; ?></p>
    <p class="titulo-campo">Código</p>
    
    <p class="contenido-campo"><?php print $registro[1]; ?></p>
    <p class="titulo-campo">Razón social</p>
    
    <p class="contenido-campo-small"><?php print $registro[2]; ?></p>
    <p class="titulo-campo">CUIT</p>
    
    <p class="contenido-campo-small"><?php print $registro[3]; ?></p>
    <p class="titulo-campo">Nombre</p>
    
    <p class="contenido-campo-small"><?php print $registro[4]; ?></p>
    <p class="titulo-campo">Domicilio</p>
    
    <p class="contenido-campo-small"><?php print $registro[5]; ?></p>
    <p class="titulo-campo">Telefono</p>
    
    <p class="contenido-campo-small"><?php print $provincias->get_descripcion_provincia($registro[6]); ?></p>
    <p class="titulo-campo">Provincia</p>
    
    <p class="contenido-campo-small"><?php print $localidades->get_descripcion_localidad($registro[7]); ?></p>
    <p class="titulo-campo">Localidad</p>
</div>
<div class="grupo-campos grupo-campos-chico">
    <p class="contenido-campo-small"><?php print $registro[8]; ?></p>
    <p class="titulo-campo">Código Postal</p>
    
    <p class="contenido-campo-small"><?php print $registro[9]; ?></p>
    <p class="titulo-campo">Contacto</p>
    
    <p class="contenido-campo-small"><?php print $registro[10]; ?></p>
    <p class="titulo-campo">Página</p>
    
    <p class="contenido-campo-small"><?php print $registro[11]; ?></p>
    <p class="titulo-campo">Correo</p>
    
    <p class="contenido-campo-small"><?php print $registro[12]; ?></p>
    <p class="titulo-campo">Saldo</p>
    
    <p class="contenido-campo-small"><?php print $registro[13]; ?></p>
    <p class="titulo-campo">Total</p>
</div>