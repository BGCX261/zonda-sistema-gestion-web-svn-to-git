<?php

    class TablaArticulos {
        
        private $categorias = NULL;
        private $proveedores = NULL;
        private $marcas = NULL;
        private $alicuotas = NULL;
        private $formatter = NULL;
        private $acciones = NULL;
        private $toggle = 0;


        public function __construct() {
            include_once('include/articulos/categorias.php');
            $this->categorias = new Categorias();
            include_once('include/proveedores/proveedores.php');
            $this->proveedores = new Proveedores();
            include_once('include/articulos/marcas.php');
            $this->marcas = new Marcas();
            include_once('include/configuracion/alicuotas.php');
            $this->alicuotas = new Alicuotas();
            include_once('include/formatter.php');
            $this->formatter = new Formatter();
            include_once('include/acciones_tabla.php');
            $this->acciones = new AccionesTabla('articulos', 'form_edicion');
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
            elseif ($name == 'categoria') {
                $data = $this->categorias->get_descripcion_categoria($field);
            }
            elseif ($name == 'proveedor') {
                $data = $this->proveedores->get_field('razon', $field);
            }
            elseif ($name == 'marca') {
                $data = $this->marcas->get_descripcion_marca($field);
            }
            elseif ($name == 'alicuota') {
                $data = $this->alicuotas->get_field('alicuota', $field);
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