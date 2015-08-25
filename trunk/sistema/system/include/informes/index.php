<?php
    
    if (isset($_REQUEST["form"]) && !isset($_REQUEST["action"])) {
        include_once("include/informes/".$_REQUEST["form"].".php");
    }
    
?>