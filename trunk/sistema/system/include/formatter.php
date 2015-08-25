<?php

    class Formatter {
        
        public static function code_format($code) {
            return str_pad($code, 13, '0', STR_PAD_LEFT);
        }
        
        public static function number_format($number) {
            return number_format($number, 2);
        }
        
        public static function bool_format($bool) {
            return ($bool != 0 ? 'SI' : 'NO');
        }
        
        public static function date_format($sql_date) {
            $date_str = split(" ", $sql_date);
            $date = split("-", $date_str[0]);
            return $date[2]."-".$date[1]."-".$date[0];
        }
        
        public static function datetime_format($sql_date) {
            $date_str = split(" ", $sql_date);
            $date = split("-", $date_str[0]);
            $time = $date_str[1];
            return $date[2]."-".$date[1]."-".$date[0]." ".$time;
        }
        
    }

?>