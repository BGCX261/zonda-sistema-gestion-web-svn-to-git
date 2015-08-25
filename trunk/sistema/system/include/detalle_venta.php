<?php

    class DetalleVenta extends DetalleFactura {

        public function __construct($id_operacion, $operacion, $detalle_operacion) {
            parent::__construct($id_operacion, 0, $operacion, $detalle_operacion);
        }
        
        public function mostrar_filas() {
            $toggle = 0;
            $result = $this->get_detalle();
            $articulos = new Articulos();
            print '<tbody>';
            while ($row = mysql_fetch_array($result)) {
                print '<tr class="';
                $toggle++ % 2 == 0 ? print 'even' : print 'odd';
                print '">';
                print '<td>'.Formatter::code_format($row[2]).'</td>';
                print '<td>'.$articulos->get_articulo_descripcion($row[2]).'</td>';
                print '<td align="right">'.Formatter::number_format($row[3]).'</td>';
                print '<td align="right">'.Formatter::number_format($row[4]).'</td>';
                print '<td align="right">'.Formatter::number_format($row[4] * $row[3]).'</td>';
                print '</tr>';
            }
            print '</tbody>';
        }
        
    }
    
?>