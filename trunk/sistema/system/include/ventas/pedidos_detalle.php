<?php

    class PedidosDetalle extends TableHandler {
        
        private $id = NULL;

        public function __construct($codigo) {
            $this->id = $codigo;
            parent::__construct('pedidos_detalle');
            parent::set_filter('pedido', $this->id);
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
        
    }
    
?>