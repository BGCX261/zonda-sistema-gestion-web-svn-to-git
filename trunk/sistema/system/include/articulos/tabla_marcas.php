<?php

    class TablaMarcas extends TablaGenerica {
        
        private $marcas = NULL;

        public function __construct() {
            parent::__construct('articulos', 'form_edicion_marca');
            $this->marcas = new Marcas();
        }
        
        public function show() {
            parent::show($this->marcas->get_marcas());
        }
        
    }
    
?>