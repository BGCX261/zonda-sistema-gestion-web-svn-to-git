<?php
    $registro = array('', '', '', '');
    
    if (isset($_REQUEST["codigo"])) {
        $query = "SELECT * FROM fondos WHERE codigo = ".$_REQUEST["codigo"];
        $result = mysql_query($query);
        $registro = mysql_fetch_row($result);
    }
    
    if (isset($_REQUEST["type"])) {
        if ($_REQUEST['type'] == 'alta' || $_REQUEST['type'] == 'clonar') {
            $query = "SELECT MAX(codigo) + 1 FROM fondos";
            $result = mysql_query($query);
            $registro[0] = mysql_result($result, 0, 0);
        }
    }
    
    $action = 'edicion';
    if (isset($_REQUEST['type'])) {
        $action = $_REQUEST['type'];
    }
    
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/campo.php');
    include_once('include/campo_codigo.php');
    include_once('include/campo_oculto.php');
    include_once('include/campo_decimal.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    include_once('include/fondos/fondos.php');
    
    $campo_cod_orig = new CampoOculto('codigo-original', $registro[0]);
    $campo_include = new CampoOculto('include', 'fondos');
    $campo_action = new CampoOculto('action', $action);
    $campo_cod = new CampoCodigo('codigo', $registro[0]);
    $campo_des = new Campo('descripcion', $registro[1], 'Descripción:', 'text');
    $campo_sal = new CampoDecimal('saldo', $registro[3], 'Saldo:');
    $boton = new BotonFlat('aceptar', 'Aceptar', 'boton-aceptar');
    
?>    

<h1><?php
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] == 'alta') {
            print "Agregar un fondo";
        }
        elseif ($_REQUEST['type'] == 'clonar') {
            print "Clonaci&oacute;n de fondo";
        }
        else {
            print "Edici&oacute;n de fondo";
        }
    }
    else {
        print "Edici&oacute;n de fondo";
    }
?></h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="POST" enctype="multipart/form-data">
    <?php 
        $campo_include->show();
        $campo_action->show();
        $campo_cod_orig->show();
    ?>
    <div class="grupo-campos grupo-campos-mediano">
        <?php 
            $campo_cod->show();
            $campo_des->show();
            $campo_sal->show();
        ?>
        <br><br>
        <?php
            $boton->show();
        ?>
    </div>
</form>
