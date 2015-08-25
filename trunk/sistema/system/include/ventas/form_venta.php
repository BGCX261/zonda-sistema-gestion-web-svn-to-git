<?php
    include_once('include/formulario.php');
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/campo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    include_once('include/url_util.php');
    include_once('include/clientes/clientes.php');
    include_once('include/configuracion/tipos_facturas.php');
    include_once('include/configuracion/condiciones_venta.php');
    include_once('include/fondos/fondos.php');
    
    $formulario = new Formulario('ventas', 'form_venta', 'grabar_venta');
    $url = new UrlUtil();
    $formulario->set_action_uri($url->get_uri().'&action=grabar_venta');
    
    $campo_pedido = new CampoOculto('pedido', 0);
    
    if (isset($pedido) && !isset($_REQUEST['action'])) {
        $campo_pedido->set_value($pedido);
    }
    
    $campo_cliente = new CampoCombo('cliente', 'Cliente:');
    $campo_tipo = new CampoCombo('operacion', 'Tipo de operación:');
    $campo_condicion = new CampoCombo('condicion', 'Condición de venta:');
    $campo_fondo = new CampoCombo('fondo', 'Fondo de pago:');
    
    $clientes = new Clientes();
    if (isset($cliente)) {
        $campo_cliente->add_option($clientes->get_field('razon', $cliente), $cliente);
    }
    else {
        $campo_cliente->add_option('Seleccione un cliente...');
        $campo_cliente->set_sql_options($clientes->get_result());
        $campo_cliente->set_selected_option(0);
    }
    
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
    $boton_grabar = new BotonFlat('grabar-venta', 'Grabar la venta', 'guardar-item');
    
    $formulario->open();
    
    $campo_pedido->show();
?>

<h1>Venta de artículos</h1>

<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_cliente->show();
        $campo_tipo->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_condicion->show();
        $campo_fondo->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
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