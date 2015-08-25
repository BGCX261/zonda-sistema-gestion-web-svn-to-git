<?php

    /* REDIMENSIONA UNA IMAGEN AL TAMAÑO DESEADO. */

    if (!isset($_REQUEST['imagen']) || !isset($_REQUEST['ancho'])) {
        imagepng(imagecreatefrompng("images/articulos/sin-imagen.png"));
    }

    $ExtensionArchivo = explode(".", $_REQUEST['imagen']);
    $Extension = strtolower($ExtensionArchivo[count($ExtensionArchivo) - 1]);
    
    if ($Extension == 'jpeg' || $Extension == 'jpg') {
        $Imagen = imagecreatefromjpeg($_REQUEST['imagen']);
    } 
    else if ($Extension == 'gif') {
        $Imagen = imagecreatefromgif($_REQUEST['imagen']);
    } 
    else {
        $Imagen = imagecreatefrompng($_REQUEST['imagen']);
    }
    
    $AnchoOriginal = imagesx($Imagen);
    $AltoOriginal = imagesy($Imagen);
    
    $Relacion = $AltoOriginal / $AnchoOriginal;
    
    if ($Relacion < 1) {
        $AnchoNuevo = $_REQUEST['ancho'];
        $AltoNuevo = floor($_REQUEST['ancho'] * $Relacion);
    } 
    else {
        $AltoNuevo = $_REQUEST['ancho'];
        $AnchoNuevo = floor($_REQUEST['ancho'] * 1 / $Relacion);
    }
    
    $Thumbnail = imagecreatetruecolor($AnchoNuevo, $AltoNuevo);
    imagecopyresampled($Thumbnail, $Imagen, 0, 0, 0, 0, $AnchoNuevo, $AltoNuevo, $AnchoOriginal, $AltoOriginal);
    
    if ($Extension == 'jpeg' || $Extension == 'jpg') {
        imagejpeg($Thumbnail);
    }
    else if ($Extension == 'gif') {
        imagegif($Thumbnail);
    }
    else {
        imagepng($Thumbnail);
    }
    
?>

