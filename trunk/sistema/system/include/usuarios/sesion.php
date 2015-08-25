<?php
    include_once('../../conexion.php');
    $query = "SELECT * FROM usuarios WHERE codigo = '".$_COOKIE["usuario"];
    $Result = mysql_query($query);
    if ($Result)
        if (mysql_num_rows($Result) > 0)
            print "TRUE";
        else
            print "FALSE";
    else
        print "FALSE";
?>