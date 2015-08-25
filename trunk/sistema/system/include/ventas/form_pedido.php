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
    include_once("include/lista_articulos.php");
    include_once('include/clientes/clientes.php');
    
    if (isset($_SESSION['lista_articulos'])) {
        $_SESSION['lista_articulos'] = new ListaArticulos();
    }
    
    $formulario = new Formulario('ventas', 'form_venta', 'grabar_pedido');
    $url = new UrlUtil();
    $formulario->set_action_uri($url->get_uri().'&action=grabar_pedido');
    
    $campo_cliente = new CampoCombo('cliente', 'Cliente:');
    
    $clientes = new Clientes();
    if (isset($cliente)) {
        $campo_cliente->add_option($clientes->get_field('razon', $cliente), $cliente);
    }
    else {
        $campo_cliente->add_option('Seleccione un cliente...');
        $campo_cliente->set_sql_options($clientes->get_result());
        $campo_cliente->set_selected_option(0);
    }
    
    $boton_buscar = new BotonFlat('buscar-articulos', 'Agregar artículos', 'agregar-item');
    $boton_borrar = new BotonFlat('borrar-articulo', 'Limpiar la lista', 'borrar-item');
    $boton_grabar = new BotonFlat('grabar-pedido', 'Grabar el pedido', 'guardar-item');
    
    $formulario->open();
?>

<h1>Nuevo pedido</h1>

<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_cliente->show();
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