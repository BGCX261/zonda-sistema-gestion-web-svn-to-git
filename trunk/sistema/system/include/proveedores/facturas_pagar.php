<?php

    class FacturasPorPagar extends Compras {
        
        public function __construct() {
            parent::__construct();
            parent::set_query("SELECT codigo, factura, fecha, proveedor, monto, saldo FROM compras");
            parent::set_conditional_filter('saldo', '>', '0');
        }
        
    }

?>