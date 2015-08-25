<?php

    /**
     * Clase AccionPagarCuota
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 09/12/2014
     */
    class AccionPagarCuota extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?include=proveedores&form=form_pago_cuota&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-pagar"></a>
                    </div>';
        }
        
    }

?>