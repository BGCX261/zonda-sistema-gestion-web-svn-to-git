<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/tipos_facturas.php');
    
    $tipos = new TiposFacturas();
    
    $registro = array('', '', '0', '0');
    
    if (isset($_REQUEST["codigo"])) {
        $registro = $tipos->get_row($_REQUEST["codigo"]);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $registro[0] = $tipos->current_id() + 1;
        }
    }
    
    $action = 'edicion_tipo_factura';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'].'_tipo_factura';
    }
    
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_booleano.php');
    include_once('include/boton.php');
    
    $form = new Formulario();
    $form->set_param('action', $action);
    $form->set_param('codigo-original', $registro[0]);
    $form->set_param('include', 'configuracion');
    $form->set_param('form', 'listado_tipos');
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_cod->set_required();
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_des->set_required();
    $campo_iva = new CampoBooleano('iva', $registro[2], 'Contabiliza IVA');
    $campo_dis = new CampoBooleano('dis', $registro[3], 'Discrimina IVA');
    $boton = new Boton('aceptar', 'Aceptar');
?>

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Alta";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n";
        }
        else {
            print "Edici&oacute;n";
        }
    }
    else {
        print "Edici&oacute;n";
    }
?> de tipo de factura</h1>

<?php
    $form->open();
?>
<div class="grupo-campos grupo-campos-mediano">
    <?php 
        $campo_cod->show();
        $campo_des->show();
        $campo_iva->show();
        $campo_dis->show();
    ?>
    <p></p>
    <?php
        $boton->show();
    ?>
</div>
<?php
    $form->close();
?>