<?php
    /**
     * Clase DatosFactura
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 04/12/2014
     */
    class DatosFactura {
        
        private $persona;
        private $operacion;
        private $condicion;
        private $fondo;
                
        public function __construct($persona, $operacion, $condicion, $fondo) {
            $this->persona = $persona;
            $this->operacion = $operacion;
            $this->condicion = $condicion;
            $this->fondo = $fondo; 
        }
        
        public function get_persona() {
            return $this->persona;
        }
        
        public function get_operacion() {
            return $this->operacion;
        }
        
        public function get_condicion() {
            return $this->condicion;
        }
        
        public function get_fondo() {
            return $this->fondo;
        }
        
    }
?>