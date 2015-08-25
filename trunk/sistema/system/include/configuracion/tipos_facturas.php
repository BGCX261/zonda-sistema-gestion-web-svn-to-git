<?php

    class TiposFacturas extends TableHandler {
        
        public function __construct() {
            parent::__construct('tipos_facturas');
        }
        
        function add($id, $des, $iva, $dis) {
            $query = "INSERT INTO tipos_facturas (codigo, descripcion, iva, discrimina) VALUES (".$id.", '".$des."', ".$iva.", ".$dis.")";
            return mysql_query($query);
        }
        
        function edit($id, $cod, $des, $iva, $dis) {
            $query = "UPDATE tipos_facturas SET codigo = ".$cod.", descripcion = '".$des."', iva = ".$iva.", discrimina = ".$dis." WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete($id) {
            $query = "DELETE FROM tipos_facturas WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
    }
    
?>