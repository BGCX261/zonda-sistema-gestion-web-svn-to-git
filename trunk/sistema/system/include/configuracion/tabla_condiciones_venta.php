<?php
    /**
     * Clase TablaCondicionesVenta
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 27/12/2014
     */
    class TablaCondicionesVenta extends TablaGenerica {
        
        private $condiciones = NULL;

        public function __construct() {
            parent::__construct('configuracion', 'form_edicion_condicion');
            $this->condiciones = new CondicionesVenta();
        }
        
        public function show() {
            parent::show($this->condiciones->get_result());
        }
        
    }
?>
