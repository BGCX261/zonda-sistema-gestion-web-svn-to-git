<?php
    /**
     * Clase Encabezado
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 13/12/2014
     */
    class Encabezado {
        
        private $campos = NULL;
                
        function __construct($campos) {
            $this->campos = $campos;
        }
        
        function show() {
            print '<thead class="ui-widget-header"><tr>';
            foreach($this->campos as $campo) {
                print '<th class="header" field="'.strtolower($campo['nombre']).'" width="'.$campo['ancho_celda'].'%" align="'.$campo['alineacion'].'">'.$campo['titulo'].'</th>';
            }
            print '<th></th></tr></thead>';
        }
        
    }

?>