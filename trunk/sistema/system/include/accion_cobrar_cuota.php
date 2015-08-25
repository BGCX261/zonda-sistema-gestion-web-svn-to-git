<?php

    /**
     * Clase AccionPagarCuota
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 11/12/2014
     */
    class AccionCobrarCuota extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?include=clientes&form=form_pago_cuota&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-pagar"></a>
                    </div>';
        }
        
    }

?>