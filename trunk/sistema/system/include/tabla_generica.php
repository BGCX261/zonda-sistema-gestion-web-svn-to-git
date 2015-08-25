<?php

    class TablaGenerica {
        
        private $formatter = NULL;
        private $acciones = NULL;
        private $encabezado = NULL;
        private $toggle = 0;

        public function __construct($include = '', $form = '') {
            $this->formatter = new Formatter();
            if (!empty($include) && !empty($form)) {
                $this->acciones = new AccionesTabla($include, $form);
            }
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
        
        public function iniciar_tabla($nombre) {
            print '<table id="'.$nombre.'" name="'.$nombre.'" class="ui-widget tabla-datos">';
            if (!is_null($this->encabezado)) {
                $this->encabezado->show();
            }
        }
        
        public function cerrar_tabla() {
            print '</table>';
        }
        
        public function iniciar_fila() {
            print '<tr class="'.($this->toggle++ % 2 == 0 ? "even" : "odd").'">';
        }
        
        public function mostrar_fila($result, $fila) {
            foreach ($fila as $key => $data) {
                $field = mysql_field_name($result, $key);
                $data = $this->formato_campo($data, $field);
                print '<td field="'.$field.'" align="'.(is_numeric($data) && $field != 'codigo' ? 'right' : 'left').'">'.$data.'</td>';
            }
            if (isset($this->acciones)) {
                print '<td class="funciones-tabla" align="right">'.$this->agregar_acciones($fila[0]).'</td>';
            }
        }
        
        public function cerrar_fila() {
            print '</tr>';
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if (strstr($name, 'codigo')) {
                $data = $this->formatter->code_format($field);
            }
            elseif (strstr($name, 'fecha')) {
                $data = $this->formatter->datetime_format($field);
            }
            elseif (is_numeric($field)) {
                $data = $this->formatter->number_format($field);
            }
            return $data;
        }
        
        public function agregar_acciones($id) {
            $this->acciones->set_code($id);
            return $this->acciones->show();
        }
        
        public function get_formatter() {
            return $this->formatter;
        }
        
        public function get_actions() {
            return $this->acciones;
        }
        
        public function set_actions($actions) {
            $this->acciones = $actions;
        }
        
        public function set_encabezado($encabezado) {
            $this->encabezado = $encabezado;
        }
        
    }
    
?>