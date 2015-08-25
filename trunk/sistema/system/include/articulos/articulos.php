 <?php

    class Articulos {
        
        private $query = 'SELECT codigo, descripcion, categoria, proveedor, marca, costo, precio, alicuota, existencia FROM articulos';
        private $filter = NULL;
        private $order = NULL;
        private $limit = NULL;
                
        public function get_articulos() {
            $query = $this->query . $this->filter . $this->order . $this->limit;
            return mysql_query($query);
        }
        
        public function get_articulo_descripcion($id) {
            $query = 'SELECT descripcion FROM articulos WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        public function get_articulo($id) {
            $query = 'SELECT * FROM articulos WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_array($result);
        }
        
        public function get_count() {
            $query = "SELECT COUNT(*) FROM articulos".$this->filter;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        public function reset_filter() {
            $this->limit = NULL;
        }
                
        public function set_codigo_filter($value) {
            $this->init_filter();
            $this->filter .= " codigo LIKE '".$value."%' ";
        }
                
        public function set_descripcion_filter($value) {
            $this->init_filter();
            $this->filter .= " descripcion LIKE '%".$value."%' ";
        }
                
        public function set_categoria_filter($value) {
            $this->init_filter();
            $this->filter .= " categoria IN (SELECT codigo FROM categorias WHERE categoria LIKE '%".$value."%') ";
        }
                
        public function set_proveedor_filter($value) {
            $this->init_filter();
            $this->filter .= " proveedor IN (SELECT codigo FROM proveedores WHERE razon LIKE '%".$value."%') ";
        }
                
        public function set_marca_filter($value) {
            $this->init_filter();
            $this->filter .= " marca IN (SELECT codigo FROM marcas WHERE descripcion LIKE '%".$value."%') ";
        }
                
        public function set_costo_filter($value) {
            $this->init_filter();
            $this->filter .= " costo LIKE '".$value."%'";
        }
                
        public function set_precio_filter($value) {
            $this->init_filter();
            $this->filter .= " precio LIKE '".$value."%'";
        }
                
        public function set_alicuota_filter($value) {
            $this->init_filter();
            $this->filter .= " alicuota IN (SELECT codigo FROM alicuotas WHERE descripcion LIKE '%".$value."%') ";
        }
                
        public function set_existencia_filter($value) {
            $this->init_filter();
            $this->filter .= " existencia LIKE '".$value."%'";
        }
        
        public function set_order($field, $order) {
            $this->order = ' ORDER BY '.$field.' '.$order;
            if ($field != 'codigo') {
                $this->order .= ', codigo';
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
        
        public function set_busqueda_filter($search) {
            $this->init_filter();
            $this->filter .= " descripcion LIKE '%".$search."%' OR codigo LIKE '".$search."%' ";
        }

        private function init_filter() {
            if (is_null($this->filter)) {
                $this->filter = ' WHERE ';
            }
            else {
                $this->filter .= ' AND ';
            }
        }
        
    }

?>