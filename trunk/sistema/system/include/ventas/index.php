<?php
    
    $form = $_REQUEST["form"];
    if (isset($form) && !isset($action)) {
        include_once("include/ventas/$form.php");
    }
    
?>