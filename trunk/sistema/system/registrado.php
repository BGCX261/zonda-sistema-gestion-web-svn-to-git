<?php
    $Encabezado = "From: ".$_POST['correo'];
    
    $Mensaje = "
        \nNombre:\t".$_POST['nombre']."
        \nCompania:\t".$_POST['compania']."
        \nRubro:\t".$_POST['rubro']."
        \nCorreo:\t".$_POST['correo']."
        \nTelefono:\t".$_POST['telefono'];
    $Mensaje = stripslashes($Mensaje);
    $Mensaje = strip_tags($Mensaje);
    
    ini_set('sendmail_from', $_POST['correo']);
    
    $Result = mail("jmscarciofolo@gmail.com", "Registro de cliente de Gestion Web", $Mensaje, $Encabezado);
    
    if (!$Result) {
        print "<p>Ha ocurido un error al intentar enviar el correo!</p>";
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
            '".verificar_sql($_POST['nombre'])."',
            '".verificar_sql($_POST['compania'])."',
            '".verificar_sql($_POST['rubro'])."',
            '".verificar_sql($_POST['correo'])."',
            '".verificar_sql($_POST['telefono'])."'
        )";
    
    if (!mysql_query($query)) {
        print "<p>Ha ocurido un error al intentar realizar el registro!</p>";
        return;
    }
    
    print "<h1>Gracias por registrar su sistema!</h1>
        <p><br>A partir de ahora recibir&aacute; las actualizaciones necesarias para corregir errores y ampliar las funcionalidades del sistema.</p>
        <p>Muchas gracias por confiar en nosotros a administraci&oacute;n de su negocio.<br><br><br></p>
        <p>El equipo de Gesti&oacute;n Web</p>";
?>