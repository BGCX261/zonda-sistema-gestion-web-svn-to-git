<?php
    /**
     * Clase TablaTiposFacturas
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 10/01/2015
     */
    class TablaTiposFacturas extends TablaGenerica {
        
        private $tipos = NULL;

        public function __construct() {
            parent::__construct('configuracion', 'form_edicion_tipo_factura');
            $this->tipos = new TiposFacturas();
        }
        
        public function show() {
            parent::show($this->tipos->get_result());
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if (strstr($name, 'codigo')) {
                $data = Formatter::code_format($field);
            }
            elseif (strstr($name, 'fecha')) {
                $data = Formatter::datetime_format($field);
            }
            elseif (strstr($name, 'iva')) {
                $data = Formatter::bool_format($field);
            }
            elseif (strstr($name, 'discrimina')) {
                $data = Formatter::bool_format($field);
            }
            elseif (is_numeric($field)) {
                $data = Formatter::number_format($field);
            }
            return $data;
        }
        
    }
?>
