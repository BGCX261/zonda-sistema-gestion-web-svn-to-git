<?php

    class TablaListasPrecios extends TablaGenerica {
        
        private $listas_precios = NULL;

        public function __construct() {
            parent::__construct('articulos', 'form_edicion_lista_precios');
            $this->listas_precios = new ListasPrecios();
        }
        
        public function show() {
            parent::show($this->listas_precios->get_listas());
        }
        
    }
    
?>