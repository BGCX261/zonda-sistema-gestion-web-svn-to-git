<?php

    /**
     * Clase AccionBorrarActivar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 13/12/2014
     */
    class AccionBorrarActivar extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?'.parent::get_uri().'&action=descartar&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-borrar"></a>
                        <a href="?'.parent::get_uri().'&action=activar&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-procesar"></a>
                    </div>';
        }
        
    }

?>