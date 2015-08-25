<?php 

    class ListaDePrecios {
        
        private $lista;
        private $query = 'SELECT listas_precios_detalle.codigo, articulos.codigo, articulos.descripcion, articulos.costo, listas_precios_detalle.precio FROM listas_precios_detalle, articulos';
        private $filter;
        private $limit;
        private $order;

        public function __construct($lista) {
            $this->lista = $lista;
            $this->filter = NULL;
            $this->limit = NULL;
            $this->order = NULL;
        }
                
        public function get_lista_articulos() {
            $this->init_filter();
            $query = $this->query . $this->filter . $this->order . $this->limit;
            return mysql_query($query);
        }
        
        public function get_lista() {
            return $this->lista;
        }
        
        public function get_count() {
            $this->init_filter();
            $query = "SELECT COUNT(*) FROM listas_precios_detalle, articulos ".$this->filter;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        public function get_precio($id_articulo) {
            $query = "SELECT precio FROM listas_precios_detalle WHERE articulo = ".$id_articulo;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        public function reset_filter() {
            $this->limit = NULL;
        }
                
        public function set_codigo_filter($value) {
            $this->init_filter();
            $this->filter .= " AND articulos.codigo LIKE '".$value."%' ";
        }
                
        public function set_descripcion_filter($value) {
            $this->init_filter();
            $this->filter .= " AND articulos.descripcion LIKE '%".$value."%' ";
        }
                
        public function set_categoria_filter($value) {
            $this->init_filter();
            $this->filter .= " AND articulos.categoria IN (SELECT codigo FROM categorias WHERE categoria LIKE '%".$value."%') ";
        }
                
        public function set_proveedor_filter($value) {
            $this->init_filter();
            $this->filter .= " AND articulos.proveedor IN (SELECT codigo FROM proveedores WHERE razon LIKE '%".$value."%') ";
        }
                
        public function set_marca_filter($value) {
            $this->init_filter();
            $this->filter .= " AND articulos.marca IN (SELECT codigo FROM marcas WHERE descripcion LIKE '%".$value."%') ";
        }
                
        public function set_costo_filter($value) {
            $this->init_filter();
            $this->filter .= " AND articulos.costo LIKE '".$value."%'";
        }
                
        public function set_precio_filter($value) {
            $this->init_filter();
            $this->filter .= " AND listas_precios_detalle.precio LIKE '".$value."%'";
        }
        
        public function set_order($field, $order) {
            $this->order = ' ORDER BY '.$field.' '.$order;
            if ($field != 'articulos.codigo') {
                $this->order .= ', articulos.codigo';
            }
        }
        
        public function reset_order() {
            $this->order = NULL;
        }
        
        public function set_limit($init, $limit) {
            $this->limit = ' LIMIT '.$init.', '.$limit;
        }
        
        public function reset_limit() {
            $this->limit = NULL;
        }

        private function init_filter() {
            if (is_null($this->filter)) {
                $this->filter = ' WHERE listas_precios_detalle.articulo = articulos.codigo AND listas_precios_detalle.lista = '.$this->lista;
            }
        }
        
        public function update_precio_porcentaje($value) {
            $this->init_filter();
            $query = "UPDATE listas_precios_detalle, articulos SET listas_precios_detalle.precio = articulos.costo * (1 + (".($value / 100)."))";
            $query .= $this->filter;
            return mysql_query($query);
        }
        
        public function update_precio_valor($value) {
            $this->init_filter();
            $query = "UPDATE listas_precios_detalle, articulos SET listas_precios_detalle.precio = articulos.costo + ".$value;
            $query .= $this->filter;
            return mysql_query($query);
        }
        
        public function update_precio($value) {
            $this->init_filter();
            $query = "UPDATE listas_precios_detalle, articulos SET listas_precios_detalle.precio = ".$value;
            $query .= $this->filter;
            return mysql_query($query);
        }
        
    }
    
?>