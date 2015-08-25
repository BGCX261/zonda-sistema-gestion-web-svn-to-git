<?php

    class FacturasPorCobrar extends Ventas {
        
        public function __construct() {
            parent::__construct();
            parent::set_query("SELECT codigo, factura, fecha, cliente, monto, saldo FROM ventas");
            parent::set_conditional_filter('saldo', '>', '0');
        }
        
    }

?>