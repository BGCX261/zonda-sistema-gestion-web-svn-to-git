<?php
    include_once('../../conexion.php');
    include_once('categorias.php');
    
    $categorias = new Categorias();
    
    $registro = $categorias->get_categoria($_REQUEST['codigo']);
?>
<div class="grupo-campos grupo-campos-chico">
    <img class="imagen imagen-chica" src="<?php empty($registro[3]) ? print 'images/sin-imagen.png' : print $registro[3]; ?>" />
</div>
<div class="grupo-campos grupo-campos-mediano">
    <p class="contenido-campo"><?php print $registro[0]; ?></p>
    <p class="titulo-campo">Código</p>
    
    <p class="contenido-campo"><?php print $registro[1]; ?></p>
    <p class="titulo-campo">Descripción</p>
    
    <p>&nbsp;</p>
    
    <?php if (isset($registro[2])) { ?>
        <p class="contenido-campo-small"><?php print $registro[2]; ?></p>
        <p class="titulo-campo">Categoría superior</p>
    <?php } ?>
</div>