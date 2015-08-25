<?php    
    include_once('../../conexion.php');
    $query = "SELECT codigo FROM usuarios WHERE apodo = '".$_POST['apodo']."'";
    $Result = mysql_query($query);
    if (!$Result) {
       print "Ha ocurrido un error al intentar consultar la información en la base de datos! ";
       print mysql_error();
       return;
    }
    if (mysql_num_rows($Result) > 0) {
       print "El nombre de usuario ya ha sido registrado! Por favor, seleccione otro nombre.";
       return;
    }
    print "0";
?>