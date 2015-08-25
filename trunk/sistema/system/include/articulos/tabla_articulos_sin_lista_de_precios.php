<?php

    class TablaArticulosSinListaDePrecios {
        
        private $articulos = NULL;
        private $formatter = NULL;
        private $toggle = 0;

        public function __construct($articulos) {
            $this->articulos = $articulos;
            $this->formatter = new Formatter();
        }
        
        public function show() {
            print '<tbody>';
            $result = $this->articulos->get_lista_articulos();
            while ($row = mysql_fetch_row($result)) {
                $this->iniciar_fila();
                $this->mostrar_fila($row);
                $this->cerrar_fila();
            }
            print '</tbody>';
        }
        
        public function iniciar_fila() {
            print '<tr class="'.($this->toggle++ % 2 == 0 ? "even" : "odd").'">';
        }
        
        public function mostrar_fila($fila) {
            print '<td field="none" class="celda-agregar-item"><div class="indicador-accion"></div></td>';
            print '<td field="codigo" align="left">'.$fila[0].'</td>';
            print '<td field="descripcion" align="left">'.$fila[1].'</td>';
            print '<td align="left"><input type="text" class="precio-sin-lista campo campo-tabla ui-widget-content ui-corner-all" name="precio" lista="'.$this->articulos->get_lista().'" codigo="'.$fila[0].'" value="'.$fila[2].'" /></td>';
            print '<td class="celda-estado-consulta"><div class="estado-consulta"></div></td>';
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
        
    }
    
?>