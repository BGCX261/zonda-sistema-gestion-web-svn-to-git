<?php

    /**
     * Clase AccionBorrarProcesar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 25/11/2014
     */
    class AccionBorrarProcesar extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?'.parent::get_uri().'&action=baja&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-borrar"></a>
                        <a href="?include=ventas&form=procesar&pedido=1&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-procesar"></a>
                    </div>';
        }
        
    }

?>