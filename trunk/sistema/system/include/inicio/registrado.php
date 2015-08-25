<?php
    $Encabezado = "From: ".$_REQUEST['correo'];
    
    $Mensaje = "
        \nNombre:\t".$_REQUEST['nombre']."
        \nCompania:\t".$_REQUEST['compania']."
        \nRubro:\t".$_REQUEST['rubro']."
        \nCorreo:\t".$_REQUEST['correo']."
        \nTelefono:\t".$_REQUEST['telefono'];
    $Mensaje = stripslashes($Mensaje);
    $Mensaje = strip_tags($Mensaje);
    
    ini_set('sendmail_from', $_REQUEST['correo']);
    
    $Result = mail("jmscarciofolo@gmail.com", "Registro de cliente de Gestion Web", $Mensaje, $Encabezado);
    
    if (!$Result) {
        error_msg("Ha ocurrido un error al intentar enviar el correo! Verifique los datos o vuelva a intentarlo nuevamente.");
        return;
    }
    
    include_once('conexion.php');
    include_once('include/util.php');
    
    $query = "
        INSERT INTO registro (
            nombre,
            compania,
            rubro,
            correo,
            telefono
        )
        VALUES (
            '".verificar_sql($_REQUEST['nombre'])."',
            '".verificar_sql($_REQUEST['compania'])."',
            '".verificar_sql($_REQUEST['rubro'])."',
            '".verificar_sql($_REQUEST['correo'])."',
            '".verificar_sql($_REQUEST['telefono'])."'
        )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    print "<h1>Gracias por registrar su sistema!</h1>
        <p><br>A partir de ahora recibir&aacute; las actualizaciones necesarias para corregir errores y ampliar las funcionalidades del sistema.</p>
        <p>Muchas gracias por confiar en nosotros la administraci&oacute;n de su negocio.<br><br><br></p>
        <h2 style='float: right'>El equipo de Gesti&oacute;n Web</h2>";
?>