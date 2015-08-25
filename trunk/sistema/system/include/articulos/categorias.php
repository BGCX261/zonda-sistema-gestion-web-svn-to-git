<?php

    class Categorias {
        
        function get_categorias() {
            $query = 'SELECT codigo, descripcion FROM categorias';
            return mysql_query($query);
        }
        
        function get_sub_categorias($padre) {
            $query = 'SELECT codigo, descripcion FROM categorias WHERE padre = '.$padre;
            return mysql_query($query);
        }
        
        function get_categoria($id) {
            $query = 'SELECT cat.codigo, cat.descripcion, (SELECT descripcion FROM categorias WHERE codigo = cat.padre), cat.imagen FROM categorias cat WHERE cat.codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_row($result);
        }
        
        function get_descripcion_categoria($id) {
            $query = 'SELECT descripcion FROM categorias WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        function add_categoria($id, $name) {
            $query = "INSERT INTO categorias (codigo, descripcion) VALUES (".$id.", '".$name."')";
            return mysql_query($query);
        }
        
        function edit_categoria($id, $name) {
            $query = "UPDATE categorias SET descripcion = '".$name."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete_categoria($id) {
            $query = "DELETE FROM categorias WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function add_image($id, $path) {
            $query = "UPDATE categorias SET imagen = '".$path."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
    }
    
?>