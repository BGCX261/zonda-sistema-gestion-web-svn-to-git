<?php

    class Carrito {
        
        const ANULADO = -1;
        
        var $articulos;
        var $id_articulos;
        var $num_articulos;
        var $campos;
        var $total;
        var $iva;
        
        function Carrito() {
            $this->articulos = array();
            $this->id_articulos = array();
            $this->num_articulos = 0;
            $this->campos = '';
        }
        
        function agregar($codigo, $descripcion, $cantidad, $precio, $alicuota) {
            if ($this->en_carrito($codigo)) {
                $this->articulos[$this->id_articulos[$codigo]]['cantidad'] += $cantidad;
            }
            else {
                $this->articulos[] = array(
                    'codigo' => $codigo,
                    'descripcion' => $descripcion,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'alicuota' => $alicuota
                );
                $this->id_articulos[$codigo] = sizeof($this->articulos) - 1;
                $this->num_articulos++;
            }
            $total = 0;
            $iva = 0;
            for ($i = 0; $i < sizeof($this->articulos); $i++) {
                if ($this->articulos[$i] != NULL && $this->id_articulos[$this->articulos[$i]['codigo']] != self::ANULADO) {
                    $total += $this->articulos[$i]['precio'] * $this->articulos[$i]['cantidad'];
                    $iva += $this->articulos[$i]['precio'] * $this->articulos[$i]['cantidad'] * $this->articulos[$i]['alicuota'] / 100;
                }
            }
            $this->total = $total;
            $this->iva = $iva;
        }
        
        function eliminar($codigo){
            $this->articulos[$this->id_articulos[$codigo]] = NULL;
            $this->id_articulos[$codigo] = self::ANULADO;
            unset($this->articulos[$this->id_articulos[$codigo]]);
            unset($this->id_articulos[$codigo]);
            $this->num_articulos--;
        }
        
        function campos_form($campos) {
            $this->campos = $campos;
        }
        
        function mostrar($formulario) {
            $total = 0;
            $iva = 0;
            print '<table class="ui-widget tabla-datos tabla-carrito" cellpadding="0" cellspacing="0">
                      <thead class="ui-widget-header">
                        <tr>
                           <th>Codigo</th>
                           <th>Descripción</th>
                           <th>Precio</th>
                           <th>Alicuota</th>
                           <th>Cantidad</th>';
            if ($formulario) {
                print '<th> </th>';
            }
            print '</tr></thead><tbody>';
            for ($i = 0; $i < $this->num_articulos; $i++) {
                if ($this->articulos[$i] != NULL && $this->id_articulos[$this->articulos[$i]['codigo']] != self::ANULADO) {
                    print '<tr class="';
                    $i % 2 == 0 ? print 'even' : print 'odd';
                    print '">';
                    print '<td align="right">'.$this->articulos[$i]['codigo'].'</td>';
                    print '<td>'.$this->articulos[$i]['descripcion'].'</td>';
                    print '<td align="right">'.$this->articulos[$i]['precio'].'</td>';
                    print '<td align="right">'.$this->articulos[$i]['alicuota'].'</td>';
                    print '<td align="right">'.$this->articulos[$i]['cantidad'].'</td>';
                    if ($formulario) {
                        print '<td>';
                        print '<form>';
                        print $this->campos;
                        print '<input type="hidden" name="eliminar_articulo" value="'.$this->articulos[$i]['codigo'].'" />';
                        print '<input type="submit" value="Eliminar" />';
                        print '</form>';
                        print '</td>';
                    }
                    print '</tr>';
                    $total += $this->articulos[$i]['precio'] * $this->articulos[$i]['cantidad'];
                    $iva += $this->articulos[$i]['precio'] * $this->articulos[$i]['cantidad'] * $this->articulos[$i]['alicuota'] / 100;
                }
            }
            print '<tr class="totales-tabla separador-tabla"><td></td><td></td><td></td>';
            if ($formulario) {
                print '<td></td>';
            }
            print '<td>SUBTOTAL:</td><td align="right">'.number_format($total, 2).'</td></tr>';
            print '<tr class="totales-tabla"><td></td><td></td><td></td>';
            if ($formulario) {
                print '<td></td>';
            }
            print '<td>IVA:</td><td align="right">'.number_format($iva, 2).'</td></tr>';
            print '<tr class="totales-tabla"><td></td><td></td><td></td>';
            if ($formulario) {
                print '<td></td>';
            }
            print '<td>TOTAL:</td><td align="right">'.number_format($total + $iva, 2).'</td></tr>';
            print '</tbody>';
            print '</table>';
        }
        
        function en_carrito($codigo) {
            if(array_key_exists($codigo, $this->id_articulos)) {
                if ($this->id_articulos[$codigo] != self::ANULADO) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        
        function traer_articulo($codigo) {
            if (isset($this->id_articulos[$codigo]) && $this->id_articulos[$codigo] != self::ANULADO) {
                return $this->articulos[$this->id_articulos[$codigo]];
            }
            return NULL;
        }
        
        function cantidad_articulos() {
            return $this->num_articulos;
        }
        
        function traer_articulos() {
            return $this->id_articulos;
        }
        
        function array_articulos() {
            $arr_art = array();
            for ($i = 0; $i < sizeof($this->articulos); $i++) {
                if ($this->articulos[$i] != NULL && $this->id_articulos[$this->articulos[$i]['codigo']] != self::ANULADO) {
                    $arr_art[] = $this->articulos[$i];
                }
            }
            return $arr_art;
        }
         
        function total_carrito() {
            return $this->total;
        }
        
        function iva_carrito() {
            return $this->iva;
        }
         
    }
    
?>