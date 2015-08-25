<?php
    /**
     * Clase TablaPedidos
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 02/12/2014
     */
    class TablaPedidos extends TablaGenerica {
        
        private $pedidos = NULL;
        private $clientes = NULL;
        private $acciones = NULL;


        public function __construct() {
            parent::__construct('ventas', 'listado_pedidos');
            $this->pedidos = new Pedidos();
            $this->clientes = new Clientes();
            $this->acciones = new AccionBorrarProcesar();
            parent::set_actions($this->acciones);
        }
        
        public function show() {
            parent::show($this->pedidos->get_result());
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if ($name == 'codigo') {
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
        
        public function get_count() {
            return $this->pedidos->get_count();
        }
        
        public function get_pedidos() {
            return $this->pedidos;
        }
        
    }
    
?>