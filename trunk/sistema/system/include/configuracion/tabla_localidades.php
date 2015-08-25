<?php
    /**
     * Clase TablaLocalidades
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 23/12/2014
     */
    class TablaLocalidades extends TablaGenerica {
        
        private $localidades = NULL;

        public function __construct($localidad) {
            parent::__construct('configuracion', 'form_edicion_localidad');
            $this->localidades = new Localidades($localidad);
        }
        
        public function show() {
            parent::show($this->localidades->get_localidades());
        }
        
    }
?>