<?php

    class Localidades {
        
        private $provincia = 0;
                
        function __construct($provincia) {
            $this->provincia = $provincia;
        }
                
        function get_localidades() {
            $query = 'SELECT codigo, descripcion FROM localidades WHERE provincia = '.$this->provincia;
            return mysql_query($query);
        }
        
        function get_localidad($id) {
            $query = 'SELECT * FROM localidades WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_row($result);
        }
        
        function get_descripcion_localidad($id) {
            $query = 'SELECT descripcion FROM localidades WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        function add_localidad($name) {
            $query = "INSERT INTO localidades (descripcion, provincia) VALUES ('".$name."', ".$this->provincia.")";
            return mysql_query($query);
        }
        
        function edit_localidad($id, $name) {
            $query = "UPDATE localidades SET descripcion = '".$name."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete_localidad($id) {
            $query = "DELETE FROM localidades WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function current_id() {
            $query = "SELECT MAX(codigo) FROM localidades";
            $result = mysql_query($query);
            return mysql_result($result, 0, 0);
        }
        
    }
    
?>