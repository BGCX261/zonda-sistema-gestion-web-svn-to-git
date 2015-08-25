<?php

    class ListasPrecios {

        function get_listas() {
            $query = 'SELECT codigo, descripcion, DATE_FORMAT(actualizacion, "%d-%m-%Y %H:%i:%s") actualizacion FROM listas_precios ORDER BY codigo';
            return mysql_query($query);
        }
        
        function get_lista($id) {
            $query = 'SELECT * FROM listas_precios WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_row($result);
        }
        
        function get_descripcion_lista($id) {
            $query = 'SELECT descripcion FROM listas_precios WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        function add_lista($id, $name) {
            $query = "INSERT INTO listas_precios (codigo, descripcion, actualizacion) VALUES (".$id.", '".$name."', NOW())";
            return mysql_query($query);
        }
        
        function edit_lista($id, $name) {
            $query = "UPDATE listas_precios SET descripcion = '".$name."' WHERE codigo = ".$id;
            return mysql_query($query);
        }
        
        function delete_lista($id) {
            $query = "DELETE FROM listas_precios WHERE codigo = ".$id;
            return mysql_query($query);
        }

    }

?>