<?php
    
    class Clientes extends TableHandler {
        
        public function __construct() {
            parent::__construct('clientes');
            parent::set_query('SELECT codigo, razon, nombre, domicilio, telefono, provincia, localidad, cp, contacto, pagina, correo, saldo, total FROM clientes');
        }
                
        public function set_codigo_filter($value) {
            parent::set_filter('codigo', $value);
        }
                
        public function set_razon_filter($value) {
            parent::set_filter('razon', $value);
        }
                
        public function set_nombre_filter($value) {
            parent::set_filter('nombre', $value);
        }
                
        public function set_domicilio_filter($value) {
            parent::set_filter('domicilio', $value);
        }
                
        public function set_provincia_filter($value) {
            parent::set_foreign_filter('provincia', $value, 'descripcion', 'provincias');
        }
                
        public function set_localidad_filter($value) {
            parent::set_foreign_filter('localidad', $value, 'descripcion', 'localidades');
        }
                
        public function set_contacto_filter($value) {
            parent::set_filter('contacto', $value);
        }
                
        public function set_saldo_filter($value) {
            parent::set_filter('saldo', $value);
        }
                
        public function set_total_filter($value) {
            parent::set_filter('total', $value);
        }
        
    }

?>