<?php

    include_once('include/formatter.php');

    class TablaListaDePrecios {
        
        private $formatter = NULL;
        private $toggle = 0;
        private $uri = NULL;

        public function __construct() {
            $this->formatter = new Formatter();
            $uri = explode("?", $_SERVER['REQUEST_URI']);
            $this->uri = $uri[1];
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
        
        public function iniciar_fila() {
            print '<tr class="'.($this->toggle++ % 2 == 0 ? "even" : "odd").'">';
        }
        
        public function mostrar_fila($result, $fila) {
            foreach ($fila as $key => $data) {
                if ($key > 0) {
                    $field = mysql_field_name($result, $key);
                    $data = $this->formato_campo($data, $field);
                    if ($field === 'precio') {
                        print '<td align="center"><input type="text" codigo="'.$fila[0].'" class="precio-lista campo campo-tabla ui-widget-content ui-corner-all" name="costo" value="'.$data.'" /></td>';
                    }
                    else {
                        print '<td field="'.$field.'" align="'.(is_numeric($data) && $field != 'codigo' ? 'right' : 'left').'">'.$data.'</td>';
                    }
                }
            }
            print '<td class="celda-estado-consulta"><div class="estado-consulta"></div>'.$this->boton_borrar($fila[0]).'</td>';
        }
        
        public function cerrar_fila() {
            print '</tr>';
        }
        
        public function formato_campo($field, $name) {
            $data = $field;
            if ($name == 'codigo') {
                $data = $this->formatter->code_format($field);
            }
            elseif (is_numeric($field)) {
                $data = $this->formatter->number_format($field);
            }
            return $data;
        }
        
        private function boton_borrar($code) {
            return '<a href="?'.$this->uri.'&action=baja&codigo='.$code.'" class="boton-acciones accion-tabla-borrar"></a>';
        }
        
    }
    
?>