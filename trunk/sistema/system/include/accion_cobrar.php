<?php

    /**
     * Clase AccionCobrar
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 11/12/2014
     */
    class AccionCobrar extends AccionesTabla {
        
        public function __construct() {
            parent::__construct('', '');
        }
        
        public function show() {
            return '<div class="accion-tabla">
                        <a href="?include=clientes&form=form_pago&codigo='.parent::get_code().'" class="boton-acciones accion-tabla-pagar"></a>
                    </div>';
        }
        
    }

?>