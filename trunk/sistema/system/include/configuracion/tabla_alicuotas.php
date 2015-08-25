<?php
    /**
     * Clase TablaAlicuotas
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 13/12/2014
     */
    class TablaAlicuotas extends TablaGenerica {
        
        private $alicuotas = NULL;

        public function __construct() {
            parent::__construct('configuracion', 'form_edicion_alicuotas');
            $this->alicuotas = new Alicuotas();
        }
        
        public function show() {
            parent::show($this->alicuotas->get_result());
        }
        
    }
?>
