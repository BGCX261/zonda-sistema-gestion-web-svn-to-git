<?php

    class Conexion {
        
        public static function conectar() {
            if (!mysql_connect('localhost', 'root', '27416103')) {
                return FALSE;
            }
            mysql_select_db('zonda');
            mysql_query('SET NAMES "utf8"');
            return TRUE;
        }
        
    }

?>