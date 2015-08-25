<?php

    class Pedidos extends TableHandler {
        
        public function __construct() {
            parent::__construct('pedidos');
        }
        
        public function set_codigo_filter($value) {
            parent::set_filter('codigo', $value);
        }
        
        public function set_fecha_filter($value) {
            $date_arr = explode('-', $value);
            $date = array_reverse($date_arr);
            parent::set_filter('fecha', implode('-', $date));
        }
        
        public function set_cliente_filter($value) {
            parent::set_foreign_filter('cliente', $value, 'razon', 'clientes');
        }
        
    }
    
?>