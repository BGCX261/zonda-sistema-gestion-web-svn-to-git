<?php

    class DetallePedido extends DetalleFactura {
        
        public function __construct($id_operacion, $operacion, $detalle_operacion) {
            parent::__construct($id_operacion, 0, $operacion, $detalle_operacion);
        }
        
        public function mostrar_info_operacion() {
            $row = parent::get_info();
            $clientes = new Clientes();
            print '<p class="contenido-campo">'.$clientes->get_field(1, $row[2]).'</p>';
            print '<p class="titulo-campo">Cliente</p>';
            print '<p class="contenido-campo-small">'.Formatter::datetime_format($row[1]).'</p>';
            print '<p class="titulo-campo">Fecha de pedido</p>';
        }
        
        public function mostrar_encabezado() {
            print '<thead class="ui-widget-header">
                    <tr>
                    <th align="left">Código</th>
                    <th align="left">Artículo</th>
                    <th align="right">Cantidad</th>
                    </tr>
                   </thead>';
        }
        
        public function mostrar_filas() {
            $toggle = 0;
            $result = parent::get_detalle();
            $articulos = new Articulos();
            print '<tbody>';
            while ($row = mysql_fetch_array($result)) {
                print '<tr class="';
                $toggle++ % 2 == 0 ? print 'even' : print 'odd';
                print '">';
                print '<td>'.Formatter::code_format($row[2]).'</td>';
                print '<td>'.$articulos->get_articulo_descripcion($row[2]).'</td>';
                print '<td align="right">'.Formatter::number_format($row[3]).'</td>';
                print '</tr>';
            }
            print '</tbody>';
        }
        
    }
    
?>