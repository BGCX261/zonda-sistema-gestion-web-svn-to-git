<?php
    include_once('include/campo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_combo.php');
    include_once('include/campo_decimal.php');
    include_once('include/boton.php');
    include_once('include/url_util.php');
    
    $url = new UrlUtil();
    
    $campo_action = new CampoOculto('action', 'modificar_precios');
    $campo_mod = new CampoCombo('modificacion', 'Sobre el costo del artículo:');
    $campo_mod->add_option('Aplicar un porcentaje de (%)', 'porcentaje');
    $campo_mod->add_option('Incrementar un monto de ($)', 'valor');
    $campo_mod->add_option('Fijar el precio a ($)', 'precio');
    $campo_val = new CampoDecimal('valor', '0.00', '');
    $boton = new Boton('aceptar', 'Aplicar ajuste de precios');
?>

<div id="tabla-datos-calculate">
    <form class="formulario_busqueda" method="POST" action="<?php print $url->get_uri(); ?>">
        <?php 
            $campo_action->show();
            $campo_mod->show();
            $campo_val->show(); 
            $boton->show();
        ?>
        <div id="boton-calcular"><a></a></div>
    </form>
</div>