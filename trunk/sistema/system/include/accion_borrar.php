<?php

    /**
     * Clase AccionBorrar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 25/11/2014
     */
    class AccionBorrar extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?'.parent::get_uri().'&action=baja&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-borrar"></a>
                    </div>';
        }
        
    }

?>