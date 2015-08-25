<?php

    class TablaAgendaPagos extends TablaGenerica {
        
        private $facturas = NULL;

        public function __construct() {
            parent::__construct();
            $this->facturas = new AgendaPagos();
            parent::set_actions(new AccionCobrarCuota());
        }

        public function show() {
            parent::show($this->facturas->get_result());
        }
        
        public function get_facturas() {
            return $this->facturas;
        }
        
    }
    
?>