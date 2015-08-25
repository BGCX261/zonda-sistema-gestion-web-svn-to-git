<?php
    /**
     * Clase TablaFacturasCobrar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 08/12/2014
     */
    class TablaFacturasCobrar extends TablaGenerica {
        
        private $facturas = NULL;
        private $clientes = NULL;
        private $acciones = NULL;

        public function __construct() {
            parent::__construct();
            $this->facturas = new FacturasPorCobrar();
            $this->clientes = new Clientes();
            $this->acciones = new AccionCobrar();
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
            elseif ($name == 'cliente') {
                $data = $this->clientes->get_field('razon', $field);
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