<?php
    include_once('../../conexion.php');
    include_once('marcas.php');
    
    $marcas = new Marcas();
    
    $registro = $marcas->get_marca($_REQUEST['codigo']);
?>
<div class="grupo-campos grupo-campos-chico">

    <img class="imagen imagen-chica" src="<?php empty($registro[2]) ? print 'images/sin-imagen.png' : print $registro[2]; ?>" />

</div>
<div class="grupo-campos grupo-campos-mediano">

    <p class="contenido-campo"><?php print $registro[0]; ?></p>
    <p class="titulo-campo">Código</p>
    
    <p class="contenido-campo"><?php print $registro[1]; ?></p>
    <p class="titulo-campo">Descripción</p>

</div>