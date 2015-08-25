<?php
    if (isset($_REQUEST["form"])) {
        $form = $_REQUEST["form"];
        if (isset($form) && !isset($action)) {
            include_once("include/configuracion/$form.php");
        }
    }
?>