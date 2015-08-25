<?php 

    class ArticulosSinListaDePrecios {
        
        private $query = 'SELECT codigo, descripcion, costo FROM articulos';
        private $lista = NULL;
        private $filter = NULL;
        private $order = NULL;
        private $limit = NULL;
        
        public function __construct($lista) {
            $this->lista = $lista;
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
            $query = "SELECT COUNT(*) FROM articulos ".$this->filter;
            $result = mysql_query($query);
            return mysql_result($result, 0);
        }
        
        public function reset_filter() {
            $this->limit = NULL;
        }
                
        public function set_codigo_filter($value) {
            $this->init_filter();
            $this->filter .= " AND codigo LIKE '".$value."%' ";
        }
                
        public function set_descripcion_filter($value) {
            $this->init_filter();
            $this->filter .= " AND descripcion LIKE '%".$value."%' ";
        }
                
        public function set_categoria_filter($value) {
            $this->init_filter();
            $this->filter .= " AND categoria IN (SELECT codigo FROM categorias WHERE categoria LIKE '%".$value."%') ";
        }
                
        public function set_proveedor_filter($value) {
            $this->init_filter();
            $this->filter .= " AND proveedor IN (SELECT codigo FROM proveedores WHERE razon LIKE '%".$value."%') ";
        }
                
        public function set_marca_filter($value) {
            $this->init_filter();
            $this->filter .= " AND marca IN (SELECT codigo FROM marcas WHERE descripcion LIKE '%".$value."%') ";
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

        private function init_filter() {
            if (is_null($this->filter)) {
                $this->filter = ' WHERE codigo NOT IN (SELECT articulo FROM listas_precios_detalle WHERE lista = '.$this->lista.')';
            }
        }
        
    }
    
?>