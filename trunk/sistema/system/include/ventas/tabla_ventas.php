<?php
    /**
     * Clase TablaVentas
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 30/11/2014
     */
    class TablaVentas extends TablaGenerica {
        
        private $ventas = NULL;
        private $clientes = NULL;
        private $fondos = NULL;
        private $condiciones = NULL;
        private $acciones = NULL;


        public function __construct() {
            parent::__construct('ventas', 'listado_ventas');
            $this->ventas = new Ventas();
            $this->clientes = new Clientes();
            $this->fondos = new Fondos();
            $this->condiciones = new CondicionesVenta();
            $this->acciones = new AccionBorrar();
            parent::set_actions($this->acciones);
        }
        
        public function show() {
            parent::show($this->ventas->get_result());
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
            elseif ($name == 'fondo') {
                $data = $this->fondos->get_field(1, $field);
            }
            elseif ($name == 'condicion') {
                $data = $this->condiciones->get_field(1, $field);
            }
            elseif (is_numeric($field)) {
                $data = parent::get_formatter()->number_format($field);
            }
            return $data;
        }
        
        public function get_count() {
            return $this->ventas->get_count();
        }
        
        public function get_ventas() {
            return $this->ventas;
        }
        
    }
    
?>