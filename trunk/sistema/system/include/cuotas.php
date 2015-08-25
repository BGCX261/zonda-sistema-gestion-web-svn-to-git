<?php
    /**
     * Clase Cuotas
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 09/12/2014
     */
    class Cuotas {
        
        private $condiciones = NULL;
        private $operacion = NULL;
        
        public function __construct($operacion) {
            $this->condiciones = new CondicionesVenta();
            $this->operacion = new $operacion;
        }
        
        public function cuotas($id_venta) {
            $condicion = $this->operacion->get_field('condicion', $id_venta);
            return $this->condiciones->get_field('cuotas', $condicion);
        }
        
        public function cuotas_pagas($id_venta) {
            $condicion = $this->operacion->get_field('condicion', $id_venta);
            $cuotas = $this->condiciones->get_field('cuotas', $condicion);
            if ($cuotas > 0) {
                $monto = $this->operacion->get_field('monto', $id_venta);
                $saldo = $this->operacion->get_field('saldo', $id_venta);
                return round($saldo / $monto * $cuotas);
            }
            return 0;
        }
        
        public function cuotas_por_pagar($id_venta) {
            $condicion = $this->operacion->get_field('condicion', $id_venta);
            $cuotas = $this->condiciones->get_field('cuotas', $condicion);
            if ($cuotas > 0) {
                $monto = $this->operacion->get_field('monto', $id_venta);
                $saldo = $this->operacion->get_field('saldo', $id_venta);
                return $cuotas - round($saldo / $monto * $cuotas);
            }
            return 0;
        }
        
        public function monto_cuota($id_venta) {
            $condicion = $this->operacion->get_field('condicion', $id_venta);
            $cuotas = $this->condiciones->get_field('cuotas', $condicion);
            if ($cuotas > 0) {
                $monto = $this->operacion->get_field('monto', $id_venta);
                return round($monto / $cuotas, 2);
            }
            return 0;
        }
        
    }
    
?>