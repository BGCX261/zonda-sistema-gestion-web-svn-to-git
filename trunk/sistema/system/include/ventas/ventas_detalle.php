<?php

    class VentasDetalle extends TableHandler {
        
        private $venta = NULL;

        public function __construct($venta) {
            $this->venta = $venta;
            parent::__construct('ventas_detalle');
            parent::set_filter('venta', $this->venta);
        }
        
        public function set_codigo_filter($value) {
            parent::set_filter('codigo', $value);
        }
        
        public function set_articulo_filter($value) {
            parent::set_foreign_filter('articulo', $value, 'codigo', 'articulos');
        }
        
        public function set_cantidad_filter($value) {
            parent::set_filter('cantidad', $value);
        }
        
        public function set_precio_filter($value) {
            parent::set_filter('precio', $value);
        }
        
    }
    
?>