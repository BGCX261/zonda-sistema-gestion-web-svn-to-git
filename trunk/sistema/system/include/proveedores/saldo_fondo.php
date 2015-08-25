<?php
    include_once('../../conexion.php');
    
    $query = "SELECT saldo FROM fondos WHERE codigo = ". $_POST['codigo'];
    
    $Result = mysql_query($query); 
    
    if (!$Result) {
       print mysql_error();
       return;
    }
    
    $Row = mysql_fetch_array($Result);
    
    print $Row[0];
?>