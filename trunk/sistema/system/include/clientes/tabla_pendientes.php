<?php

    class TablaPendientes extends TablaGenerica {
        
        private $pendientes = NULL;
        private $provincias = NULL;
        private $localidades = NULL;
        
        public function __construct() {
            parent::__construct();
            parent::set_actions(new AccionBorrarActivar());
            $this->pendientes = new ClientesPendientes();
            $this->provincias = new Provincias();
            $this->localidades = new Localidades(0);
        }
        
        public function show() {
            parent::show($this->pendientes->get_result());
        }
        
        public function mostrar_fila($result, $fila) {
            foreach ($fila as $key => $data) {
                $field = mysql_field_name($result, $key);
                $data = $this->formato_campo($data, $field);
                if ($field == 'codigo') {
                    print '<td field="codigo" style="display: none;">'.$data.'</td>';
                }
                else {
                    print '<td field="" align="'.(is_numeric($data) && $field != 'codigo' ? 'right' : 'left').'">'.$data.'</td>';
                }
            }
            print '<td class="funciones-tabla" align="right">'.parent::agregar_acciones($fila[0]).'</td>';
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if (strstr($name, 'codigo')) {
                $data = parent::get_formatter()->code_format($field);
            }
            elseif (strstr($name, 'provincia')) {
                $data = $this->provincias->get_descripcion_provincia($field);
            }
            elseif (strstr($name, 'localidad')) {
                $data = $this->localidades->get_descripcion_localidad($field);
            }
            elseif (is_numeric($field)) {
                $data = parent::get_formatter()->number_format($field);
            }
            return $data;
        }
        
    }
    
?>