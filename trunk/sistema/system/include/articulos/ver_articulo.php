<?php
    include_once('../../conexion.php');
    include_once('articulos.php');
    include_once('categorias.php');
    include_once('../proveedores/proveedores.php');
    include_once('marcas.php');
    include_once('../configuracion/alicuotas.php');
    $articulos = new Articulos();
    $categorias = new Categorias();
    $proveedores = new Proveedores();
    $marcas = new Marcas();
    $alicuotas = new Alicuotas();
    $registro = $articulos->get_articulo($_REQUEST['codigo']);
?>
<div class="grupo-campos grupo-campos-chico">
    <img class="imagen imagen-chica" src="<?php empty($registro[9]) ? print 'images/sin-imagen.png' : print $registro[9]; ?>" />
</div>
<div class="grupo-campos grupo-campos-mediano">
    <p class="contenido-campo"><?php print $registro[0]; ?></p>
    <p class="titulo-campo">Código</p>
    
    <p class="contenido-campo"><?php print $registro[1]; ?></p>
    <p class="titulo-campo">Descripción</p>
    
    <p class="contenido-campo-small"><?php print $categorias->get_descripcion_categoria($registro[2]); ?></p>
    <p class="titulo-campo">Categoría</p>
    
    <p class="contenido-campo-small"><?php print $proveedores->get_field('razon', $registro[3]); ?></p>
    <p class="titulo-campo">Proveedor</p>
    
    <p class="contenido-campo-small"><?php print $marcas->get_descripcion_marca($registro[4]); ?></p>
    <p class="titulo-campo">Marca</p>
    
    <p class="contenido-campo-small"><?php print $registro[5]; ?></p>
    <p class="titulo-campo">Costo</p>
    
    <p class="contenido-campo-small"><?php print $registro[6]; ?></p>
    <p class="titulo-campo">Precio</p>
    
    <p class="contenido-campo-small"><?php print $alicuotas->get_alicuota($registro[7]); ?></p>
    <p class="titulo-campo">Alícuota</p>
    
    <p class="contenido-campo-small"><?php print $registro[8]; ?></p>
    <p class="titulo-campo">Existencia</p>
</div>
<div class="grupo-campos grupo-campos-chico">
    <?php print nl2br($registro[10]); ?>
</div>