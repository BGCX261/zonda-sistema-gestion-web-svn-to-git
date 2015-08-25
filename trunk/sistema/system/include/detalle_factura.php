<?php

    class DetalleFactura {
        
        private $id_operacion = NULL;
        private $operacion = NULL;
        private $detalle_operacion = NULL;
        private $cliente = NULL;

        public function __construct($id_operacion, $id_cliente, $operacion, $detalle_operacion) {
            $this->id_operacion = $id_operacion;
            $this->operacion = $operacion;
            $this->detalle_operacion = $detalle_operacion;
            $this->cliente = $id_cliente;
        }
        
        public function mostrar_detalle() {
            print '<div class="panel-todo-ancho">';
            $this->mostrar_info_operacion();
            print '</div>';
            print '<div class="panel-todo-ancho">';
            $this->mostrar_tabla_detalle();
            print '</div>';
        }
        
        public function mostrar_info_operacion() {
            $row = $this->get_info();
            print '<p class="contenido-campo">'.Formatter::code_format($row[0]).'</p>';
            print '<p class="titulo-campo">Código de operación</p>';
            print '<p class="contenido-campo-small">'.Formatter::code_format($row[1]).'</p>';
            print '<p class="titulo-campo">Número de factura</p>';
            print '<p class="contenido-campo">'.Formatter::number_format($row[6]).'</p>';
            print '<p class="titulo-campo">Monto de la factura</p>';
        }
        
        public function mostrar_tabla_detalle() {
            print '<table class="tabla-datos">';
            $this->mostrar_encabezado();
            $this->mostrar_filas();
            print '</table>';
        }
        
        public function mostrar_encabezado() {
            print '<thead class="ui-widget-header">
                    <tr>
                    <th align="left">Código</th>
                    <th align="left">Artículo</th>
                    <th align="right">Cantidad</th>
                    <th align="right">Precio</th>
                    <th align="right">Importe</th>
                    </tr>
                   </thead>';
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
                $precio = $this->get_precio($row[2]);
                print '<td align="right">'.$precio.'</td>';
                print '<td align="right">'.Formatter::number_format($precio * $row[3]).'</td>';
                print '</tr>';
            }
            print '</tbody>';
        }
        
        public function get_precio($articulo) {
            $clientes = new Clientes();
            $lista = $clientes->get_field('lista', $this->cliente);
            $lista_precios = new ListaDePrecios($lista);
            return $lista_precios->get_precio($articulo);
        }
        
        public function get_info() {
            return $this->operacion->get_row($this->id_operacion);
        }
        
        public function get_detalle() {
            return $this->detalle_operacion->get_result();
        }
        
    }
    
?>