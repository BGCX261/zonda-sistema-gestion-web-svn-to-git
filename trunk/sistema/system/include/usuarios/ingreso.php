<?php

    include_once('../conexion.php');
    include_once('../sesion.php');
    
    $query = "SELECT * FROM usuarios WHERE apodo = '".$_POST['usuario']."' AND clave = MD5('".$_POST['clave']."')";
    
    $Result = mysql_query($query);
    
    if ($Result) {
        if (mysql_num_rows($Result) > 0) {
            $Row = mysql_fetch_array($Result);
            setcookie("usuario", $Row[0], time() + 604800, "/");
            setcookie("clave", $Row[3], time() + 604800, "/");
            print "<script>";
            print "alert('Bienvenido ".$_POST["usuario"]." al sistema!');";
            print "window.location = '../../index.php';";
            print "</script>";
        }
        else {
            if (isset($_COOKIE["usuario"]) && isset($_COOKIE["clave"])) {
                setcookie("usuario", "xxx", time() - 3600, "/");
                setcookie("clave", "xxx", time() - 3600, "/");
            }
            print "<script>";
            print "alert('Los datos son incorrectos o el usuario no está registrado!');";
            print "window.location = '../../../index.php';";
            print "</script>";
        }
    }
    else {
        print "<script>";
        print "alert('Ha ocurrido un error al intentar contactar con la base de datos!');";
        print "window.location = '../../../index.php';";
        print "</script>";
    } 

?>