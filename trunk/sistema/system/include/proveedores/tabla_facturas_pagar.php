<?php
    /**
     * Clase TablaFacturasPagar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 11/12/2014
     */
    class TablaFacturasPagar extends TablaGenerica {
        
        private $facturas = NULL;
        private $proveedores = NULL;
        private $acciones = NULL;

        public function __construct() {
            parent::__construct();
            $this->facturas = new FacturasPorPagar();
            $this->proveedores = new Proveedores();
            $this->acciones = new AccionPagar();
            parent::set_actions($this->acciones);
        }
        
        public function show() {
            parent::show($this->facturas->get_result());
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if ($name == 'codigo' || $name == 'factura') {
                $data = parent::get_formatter()->code_format($field);
            }
            elseif ($name == 'fecha') {
                $data = parent::get_formatter()->datetime_format($field);
            }
            elseif ($name == 'proveedor') {
                $data = $this->proveedores->get_field('razon', $field);
            }
            elseif (is_numeric($field)) {
                $data = parent::get_formatter()->number_format($field);
            }
            return $data;
        }
        
        public function get_facturas() {
            return $this->facturas;
        }
        
        public function get_count() {
            return $this->facturas->get_count();
        }
        
    }
    
?>