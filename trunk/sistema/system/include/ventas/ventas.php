<?php

    class Ventas extends TableHandler {
        
        public function __construct() {
            parent::__construct('ventas');
        }
        
        public function set_codigo_filter($value) {
            parent::set_filter('codigo', $value);
        }
        
        public function set_factura_filter($value) {
            parent::set_filter('factura', $value);
        }
        
        public function set_fecha_filter($value) {
            $date_arr = explode('-', $value);
            $date = array_reverse($date_arr);
            parent::set_filter('fecha', implode('-', $date));
        }
        
        public function set_cliente_filter($value) {
            parent::set_foreign_filter('cliente', $value, 'razon', 'clientes');
        }
        
        public function set_fondo_filter($value) {
            parent::set_foreign_filter('fondo', $value, 'descripcion', 'fondos');
        }
        
        public function set_condicion_filter($value) {
            parent::set_foreign_filter('condicion', $value, 'descripcion', 'condiciones_venta');
        }
        
        public function set_monto_filter($value) {
            parent::set_filter('monto', $value);
        }
        
        public function set_saldo_filter($value) {
            parent::set_filter('saldo', $value);
        }
        
    }
    
?>