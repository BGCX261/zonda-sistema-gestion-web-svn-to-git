<?php

    class TablaProveedores extends TablaGenerica {
        
        private $proveedores = NULL;
        private $provincias = NULL;
        private $localidades = NULL;
        private $formatter = NULL;

        public function __construct() {
            $this->proveedores = new Proveedores();
            $this->provincias = new Provincias();
            $this->localidades = new Localidades(0);
            $this->formatter = new Formatter();
            parent::__construct('proveedores', 'form_edicion');
        }

        public function show() {
            parent::show($this->proveedores->get_result());
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if ($name == 'codigo') {
                $data = $this->formatter->code_format($field);
            }
            elseif ($name == 'provincia') {
                $data = $this->provincias->get_descripcion_provincia($field);
            }
            elseif ($name == 'localidad') {
                $data = $this->localidades->get_descripcion_localidad($field);
            }
            elseif ($name == 'telefono') {
                $data = $field;
            }
            elseif (is_numeric($field)) {
                $data = $this->formatter->number_format($field);
            }
            return $data;
        }
        
        public function get_proveedores() {
            return $this->proveedores;
        }
        
        public function get_count() {
            return $this->proveedores->get_count();
        }
        
    }
    
?>