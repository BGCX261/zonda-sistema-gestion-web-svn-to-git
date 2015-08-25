<?php

    include_once('include/formulario.php');
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/campo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    
    $formulario = new Formulario('articulos', 'form_ajuste', 'grabar_ajuste');
    
    $boton_buscar = new BotonFlat('buscar-articulos', 'Agregar artículos', 'agregar-item');
    $boton_borrar = new BotonFlat('borrar-articulo', 'Limpiar la lista', 'borrar-item');
    $boton_grabar = new BotonFlat('grabar-ajuste', 'Grabar los cambios', 'guardar-item');
    
    $formulario->open();
    
?>

<h1>Ajuste de stock</h1>

<div class="panel-todo-ancho">
    <?php
        $boton_grabar->show();
        
        $formulario->close();
        
        $boton_buscar->show();
        $boton_borrar->show();
    ?>
</div>
<div class="panel-todo-ancho" id="panel-lista-articulos-factura">
    <!-- AQUI CARGA TABLA EN AJAX -->
</div>
<div class="panel-todo-ancho" id="panel-total-articulos-factura">
    <!-- AQUI CARGA TABLA EN AJAX -->
</div>