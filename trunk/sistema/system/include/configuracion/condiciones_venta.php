<?php

    class CondicionesVenta extends TableHandler {
    
        function __construct() {
            parent::__construct('condiciones_venta');
        }
        
        function add($cod, $desc, $cuotas, $plazo, $interv, $int) {
            $query = "INSERT INTO ".parent::get_table()." (codigo, descripcion, cuotas, plazo, intervalo, interes) VALUES (".$cod.", '".$desc."', ".$cuotas.", ".$plazo.", '".$interv."', ".$int.")";
            return mysql_query($query);
        }
        
        function edit($id, $cod, $desc, $cuotas, $plazo, $interv, $int) {
            $query = "UPDATE ".parent::get_table()." SET codigo = '".$cod."', descripcion = '".$desc."', cuotas = ".$cuotas.", plazo = ".$plazo.", intervalo = '".$interv."', interes = ".$int." WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete($id) {
            $query = "DELETE FROM ".parent::get_table()." WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
    }
    
?>