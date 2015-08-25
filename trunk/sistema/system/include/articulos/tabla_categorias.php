<?php

    class TablaCategorias extends TablaGenerica {
        
        private $categorias = NULL;
        private $tab = '';

        public function __construct() {
            $this->categorias = new Categorias();
            parent::__construct('articulos', 'form_edicion_categoria');
        }
        
        public function show() {
            print '<tbody>';
            $this->mostrar_categorias(0, '');
            print '</tbody>';
        }

        public function mostrar_fila($result, $fila, $tab) {
            if ($result && mysql_numrows($result) > 0) {
                foreach ($fila as $key => $data) {
                    $field = mysql_field_name($result, $key);
                    $data = $this->formato_campo($data, $field);
                    print '<td field="'.$field.'" align="'.(is_numeric($data) && $field != 'codigo' ? 'right' : 'left').'">'.($field != 'codigo' ? $tab : '').$data.'</td>';
                }
                print '<td class="funciones-tabla" align="right">'.$this->agregar_acciones($fila[0]).'</td>';
                $this->mostrar_categorias($fila[0], $tab.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }
        
        public function mostrar_categorias($init, $tab) {
            $result = $this->categorias->get_sub_categorias($init);
            while ($row = mysql_fetch_row($result)) {
                parent::iniciar_fila();
                $this->mostrar_fila($result, $row, $tab);
                parent::cerrar_fila();
            }
        }
        
    }
    
?>