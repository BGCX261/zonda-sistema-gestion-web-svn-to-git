<?php

    class Alicuotas extends TableHandler {
        
        public function __construct() {
            parent::__construct('alicuotas');
        }
        
        function add($cod, $desc, $ali) {
            $query = "INSERT INTO ".parent::get_table()." (codigo, descripcion, alicuota) VALUES (".$cod.", '".$desc."', ".$ali.")";
            return mysql_query($query);
        }
        
        function edit($id, $cod, $desc, $ali) {
            $query = "UPDATE ".parent::get_table()." SET codigo = '".$cod."', descripcion = '".$desc."', alicuota = ".$ali." WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete($id) {
            $query = "DELETE FROM ".parent::get_table()." WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
    }
    
?>