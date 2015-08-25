<?php
    $Conexion = mysql_connect('localhost', 'root', '27416103');
    
    if (!$Conexion) {
        print "<br><b>ERROR AL INTENTAR CONECTAR CON EL SERVIDOR DE BASE DE DATOS!</b><br>";
        exit(1);
    }
    
    mysql_select_db('gestionweb6');
    
    mysql_query('SET NAMES "utf8"'); 
?>