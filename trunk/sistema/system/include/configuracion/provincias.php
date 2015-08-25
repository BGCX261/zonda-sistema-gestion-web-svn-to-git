<?php

    class Provincias {
        
        function get_provincias() {
            $query = 'SELECT codigo, descripcion FROM provincias';
            return mysql_query($query);
        }
        
        function get_provincia($id) {
            $query = 'SELECT * FROM provincias WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_row($result);
        }
        
        function get_descripcion_provincia($id) {
            $query = 'SELECT descripcion FROM provincias WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        function add_provincia($name) {
            $query = "INSERT INTO provincias (descripcion) VALUES ('".$name."')";
            return mysql_query($query);
        }
        
        function edit_provincia($id, $name) {
            $query = "UPDATE provincias SET descripcion = '".$name."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete_provincia($id) {
            $query = "DELETE FROM provincias WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function current_id() {
            $query = "SELECT MAX(codigo) FROM provincias";
            $result = mysql_query($query);
            return mysql_result($result, 0, 0);
        }
        
    }
    
?>