<?php

    class TablaClientes {
        
        private $provincias = NULL;
        private $localidades = NULL;
        private $formatter = NULL;
        private $acciones = NULL;
        private $toggle = 0;


        public function __construct() {
            include_once('include/configuracion/provincias.php');
            $this->provincias = new Provincias();
            include_once('include/configuracion/localidades.php');
            $this->localidades = new Localidades(0);
            include_once('include/formatter.php');
            $this->formatter = new Formatter();
            include_once('include/acciones_tabla.php');
            $this->acciones = new AccionesTabla('clientes', 'form_edicion');
        }

        public function show($result) {
            print '<tbody>';
            while ($row = mysql_fetch_row($result)) {
                $this->iniciar_fila();
                $this->mostrar_fila($result, $row);
                $this->cerrar_fila();
            }
            print '</tbody>';
        }
        
        private function iniciar_fila() {
            print '<tr class="'.($this->toggle++ % 2 == 0 ? "even" : "odd").'">';
        }
        
        private function mostrar_fila($result, $fila) {
            foreach ($fila as $key => $data) {
                $field = mysql_field_name($result, $key);
                $data = $this->formato_campo($data, $field);
                print '<td field="'.$field.'" align="'.(is_numeric($data) && $field != 'codigo' ? 'right' : 'left').'">'.$data.'</td>';
            }
            print '<td class="funciones-tabla" align="right">'.$this->agregar_acciones($fila[0]).'</td>';
        }
        
        private function cerrar_fila() {
            print '</tr>';
        }
        
        private function formato_campo($field, $name) {
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
        
        private function agregar_acciones($id) {
            $this->acciones->set_code($id);
            return $this->acciones->show();
        }
        
    }
    
?>