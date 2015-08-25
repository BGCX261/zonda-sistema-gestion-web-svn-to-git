<?php
    /**
     * Clase TablaProvincias
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 23/12/2014
     */
    class TablaProvincias extends TablaGenerica {
        
        private $provincias = NULL;

        public function __construct() {
            parent::__construct('configuracion', 'form_edicion_provincia');
            $this->provincias = new Provincias();
        }
        
        public function show() {
            parent::show($this->provincias->get_provincias());
        }
        
    }
?>