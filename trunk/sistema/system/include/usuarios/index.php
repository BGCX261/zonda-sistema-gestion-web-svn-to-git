<?php
    
    $form = $_REQUEST["form"];
    if (isset($form) && !isset($action)) {
        include_once("include/usuarios/$form.php");
    }
    
?>