<?php

    class Tabla extends TableHandler {
        
        public function __construct($tabla) {
            parent::__construct($tabla);
        }
        
        function add($name) {
            $query = "INSERT INTO ".parent::get_table()." (descripcion) VALUES ('".$name."')";
            return mysql_query($query);
        }
        
        function edit($id, $name) {
            $query = "UPDATE ".parent::get_table()." SET descripcion = '".$name."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete($id) {
            $query = "DELETE FROM ".parent::get_table()." WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
    }

?>