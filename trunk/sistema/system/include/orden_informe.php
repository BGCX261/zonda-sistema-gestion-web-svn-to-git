<?php
    
    if(isset($_REQUEST['filtro']) && !empty($_REQUEST['filtro']) && isset($_REQUEST['valor']) && !empty($_REQUEST['valor'])) {
        $query .= " AND ".$_REQUEST['filtro']." ".$_REQUEST['comparacion']." '".$_REQUEST['valor']."";
        if ($_REQUEST['comparacion'] == 'LIKE') {
            $query .= "%";
        }
        $query .= "' ";
    }
    
    $query .= " ORDER BY ".$_REQUEST['orden'];
    
    if(isset($_REQUEST['direccion'])) {
        $query .= " ".$_REQUEST['direccion'];
    }
    
    if(isset($_REQUEST['orden']) && $_REQUEST['orden'] != $CriterioOrden) {
        $query .= ", ".$CriterioOrden;
    }
    
?>