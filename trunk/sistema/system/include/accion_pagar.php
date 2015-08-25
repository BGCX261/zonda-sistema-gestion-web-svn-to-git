<?php

    /**
     * Clase AccionPagar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 25/11/2014
     */
    class AccionPagar extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?include=proveedores&form=form_pago&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-pagar"></a>
                    </div>';
        }
        
    }

?>