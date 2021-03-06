<?php

    include_once('include/formulario.php');
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/campo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    include_once('include/proveedores/proveedores.php');
    include_once('include/configuracion/tipos_facturas.php');
    include_once('include/configuracion/condiciones_venta.php');
    include_once('include/fondos/fondos.php');
    
    $formulario = new Formulario('compras', 'form_compra', 'grabar_compra');
    
    $campo_proveedor = new CampoCombo('proveedor', 'Proveedor:');
    $campo_tipo = new CampoCombo('operacion', 'Tipo de operación:');
    $campo_factura = new Campo('factura', '', 'Número de factura:', 'number');
    $campo_condicion = new CampoCombo('condicion', 'Condición de compra:');
    $campo_fondo = new CampoCombo('fondo', 'Fondo de pago:');
    
    $proveedores = new Proveedores();
    $campo_proveedor->add_option('Seleccione un proveedor...');
    $campo_proveedor->set_sql_options($proveedores->get_result());
    $campo_proveedor->set_selected_option(0);
    
    $tipos = new TiposFacturas();
    $campo_tipo->add_option('Seleccione una opción...');
    $campo_tipo->set_sql_options($tipos->get_result());
    $campo_tipo->set_selected_option(0);
    
    $condiciones = new CondicionesVenta();
    $campo_condicion->add_option('Seleccione una opción...');
    $campo_condicion->set_sql_options($condiciones->get_result());
    $campo_condicion->set_selected_option(0);
    
    $fondos = new Fondos();
    $campo_fondo->add_option('Seleccione una opción...');
    $campo_fondo->set_sql_options($fondos->get_result());
    $campo_fondo->set_selected_option(0);
    
    $boton_buscar = new BotonFlat('buscar-articulos', 'Agregar artículos', 'agregar-item');
    $boton_borrar = new BotonFlat('borrar-articulo', 'Limpiar la lista', 'borrar-item');
    $boton_grabar = new BotonFlat('grabar-compra', 'Grabar la compra', 'guardar-item');
    
    $formulario->open();
    
?>

<h1>Compra de artículos</h1>

<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_factura->show();
        $campo_proveedor->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_tipo->show();
        $campo_condicion->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_fondo->show();
    ?>
</div>
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