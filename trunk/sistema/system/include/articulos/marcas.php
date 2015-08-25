<?php

    class Marcas {
        
        function get_marcas() {
            $query = 'SELECT codigo, descripcion FROM marcas';
            return mysql_query($query);
        }
        
        function get_marca($id) {
            $query = 'SELECT * FROM marcas WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_row($result);
        }
        
        function get_descripcion_marca($id) {
            $query = 'SELECT descripcion FROM marcas WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        function add_marca($id, $name) {
            $query = "INSERT INTO marcas (codigo, descripcion) VALUES (".$id.", '".$name."')";
            return mysql_query($query);
        }
        
        function edit_marca($id, $name) {
            $query = "UPDATE marcas SET descripcion = '".$name."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete_marca($id) {
            $query = "DELETE FROM marcas WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
    }
    
?>