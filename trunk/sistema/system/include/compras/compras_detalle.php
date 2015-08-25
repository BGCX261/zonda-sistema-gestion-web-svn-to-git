<?php

    class ComprasDetalle extends TableHandler {
        
        private $compra = NULL;

        public function __construct($compra) {
            $this->compra = $compra;
            parent::__construct('compras_detalle');
            parent::set_filter('compra', $this->compra);
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