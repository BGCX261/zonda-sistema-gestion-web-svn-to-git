<?php

    class TablaDetalleFactura {
        
        private $toggle = 0;
        private $name = '';
        private $data_arr = NULL;
        
        public function __construct($name) {
            $this->name = $name;
        }
        
        public function set_data($data) {
            $this->data_arr = $data;
        }

        public function show() {
            $this->iniciar_tabla($this->name);
            $this->mostrar_encabezado();
            print '<tbody>';
            foreach ($this->data_arr as $fila) {
                $this->iniciar_fila();
                $this->mostrar_fila($fila);
                $this->cerrar_fila();
            }
            print '</tbody>';
            $this->cerrar_tabla();
        }
        
        public function iniciar_tabla($nombre) {
            print '<table id="'.$nombre.'" name="'.$nombre.'" class="ui-widget tabla-datos">';
        }
        
        public function cerrar_tabla() {
            print '</table>';
        }
        
        public function iniciar_fila() {
            print '<tr class="'.($this->toggle++ % 2 == 0 ? "even" : "odd").'">';
        }
        
        public function mostrar_encabezado() {
            print '<thead class="ui-widget-header"><tr>';
            print '<th class="header" field="codigo" width="15%" align="left">CODIGO</th>';
            print '<th class="header" field="descripcion" width="35%" align="left">DESCRIPCION</th>';
            print '<th class="header" field="precio" width="10%" align="right">PRECIO</th>';
            print '<th class="header" field="alicuota" width="10%" align="right">ALICUOTA</th>';
            print '<th class="header" field="cantidad" width="15%" align="center">CANTIDAD</th>';
            print '<th class="header" field="cantidad" width="10%" align="right">IMPORTE</th>';
            print '<th></th></tr></thead>';
        }
        
        public function mostrar_fila($fila) {
            print '<td field="codigo" align="left">'.$fila['codigo'].'</td>';
            print '<td field="descripcion" align="left">'.$fila['descripcion'].'</td>';
            print '<td field="precio" align="right">'.$fila['precio'].'</td>';
            print '<td field="alicuota" align="right">'.$fila['alicuota'].'</td>';
            print '<td field="cantidad" align="center"><input type="number" min="1" max="1000000" codigo="'.$fila['codigo'].'" class="cantidad-articulo campo campo-tabla ui-widget-content ui-corner-all" name="cantidad" value="'.$fila['cantidad'].'" /></td>';
            print '<td field="importe" align="right">'.number_format($fila['precio'] * $fila['cantidad'], 2).'</td>';
            print '<td class="celda-estado-consulta"><div class="estado-consulta"></div>'.$this->boton_borrar($fila['codigo']).'</td>';
        }
        
        public function cerrar_fila() {
            print '</tr>';
        }
        
        private function boton_borrar($code) {
            return '<a class="boton-acciones accion-tabla-borrar" codigo="'.$code.'"></a>';
        }
        
    }
    
?>