<?php

    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/campo_decimal.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/fondos/fondos.php');
    include_once('include/compras/compras.php');
    include_once('include/proveedores/proveedores.php');
    include_once('include/url_util.php');
    include_once('include/formatter.php');
    
    $compras = new Compras();
    $venta = $compras->get_row($_REQUEST['codigo']);
    
    $url = new UrlUtil();
    $formulario = new Formulario();
    $formulario->set_action_uri($url->get_uri().'&action=grabar_pago');
    
    $campo_codigo = new Campo('codigo', Formatter::code_format($venta[0]), 'Código de la operación', 'text');
    $campo_codigo->set_disabled();
    $campo_fecha = new Campo('fecha', Formatter::datetime_format($venta[2]), 'Fecha de compra:', 'text');
    $campo_fecha->set_disabled();
    
    $proveedores = new Proveedores();
    $campo_proveedor = new CampoOculto('proveedor', $venta[3]);
    $campo_razon_proveedor = new Campo('proveedor', $proveedores->get_field(1, $venta[3]), 'Proveedor:', 'text');
    $campo_razon_proveedor->set_disabled();
    
    $campo_monto_factura = new Campo('monto_fac', $venta[6], 'Monto de la factura:', 'text');
    $campo_monto_factura->set_disabled();
    $campo_saldo_factura = new Campo('saldo_fac', $venta[7], 'Saldo de la factura:', 'text');
    $campo_saldo_factura->set_disabled();
    
    $monto = '0';
    if (isset($monto_cuota)) {
        $monto = $monto_cuota;
    }
    $campo_monto = new CampoDecimal('monto', $monto, 'Monto a pagar:');
    
    $fondos = new Fondos();
    $campo_fondo = new CampoCombo('fondo', 'A acreditar en el fondo:');
    $campo_fondo->add_option('Seleccione una opción...');
    $campo_fondo->set_sql_options($fondos->get_result());
    $campo_fondo->set_selected_option(0);
    
    $boton_grabar = new BotonFlat('grabar-pago', 'Aceptar', 'aceptar-item');
    
    $formulario->open();
?>

<h1>Ingresar pago</h1>

<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_proveedor->show();
        $campo_codigo->show();
        $campo_fecha->show();
        $campo_razon_proveedor->show();
        $campo_monto_factura->show();
        $campo_saldo_factura->show();
    ?>
</div>
<div class="grupo-campos grupo-campos-mediano">
    <?php
        $campo_monto->show();
        $campo_fondo->show();
        print '<br><br>';
        $boton_grabar->show();
    ?>
</div>
<?php
    $formulario->close();
?>