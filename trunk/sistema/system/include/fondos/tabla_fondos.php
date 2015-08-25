<?php
    /**
     * Clase TablaFondos
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 11/12/2014
     */
    class TablaFondos extends TablaGenerica {
        
        private $fondos = NULL;

        public function __construct() {
            $this->fondos = new Fondos();
            $this->fondos->set_query("SELECT codigo, descripcion, saldo FROM fondos");
            parent::__construct('fondos', 'form_edicion');
        }
        
        public function show() {
            parent::show($this->fondos->get_result());
        }
        
    }
    
?>