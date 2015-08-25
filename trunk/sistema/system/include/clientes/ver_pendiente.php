<?php
    include_once('../table_handler.php');
    include_once('../conexion.php');
    include_once('pendientes.php');
    include_once('../configuracion/provincias.php');
    include_once('../configuracion/localidades.php');
    Conexion::conectar();
    $clientes = new ClientesPendientes();
    $provincias = new Provincias();
    $localidades = new Localidades(0);
    $registro = $clientes->get_row($_REQUEST['codigo']);
?>
<div class="grupo-campos grupo-campos-mediano">
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
</div>
<div class="grupo-campos grupo-campos-mediano">
    <p class="contenido-campo-small"><?php print $provincias->get_descripcion_provincia($registro[6]); ?></p>
    <p class="titulo-campo">Provincia</p>
    
    <p class="contenido-campo-small"><?php print $localidades->get_descripcion_localidad($registro[7]); ?></p>
    <p class="titulo-campo">Localidad</p>
    
    <p class="contenido-campo-small"><?php print $registro[8]; ?></p>
    <p class="titulo-campo">Código Postal</p>
    
    <p class="contenido-campo-small"><?php print $registro[9]; ?></p>
    <p class="titulo-campo">Contacto</p>
    
    <p class="contenido-campo-small"><?php print $registro[10]; ?></p>
    <p class="titulo-campo">Página</p>
    
    <p class="contenido-campo-small"><?php print $registro[11]; ?></p>
    <p class="titulo-campo">Correo</p>
</div>