<?php
 
    /**
     * Clase TableHandler
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 25/11/2014
     */
    class TableHandler {
        
        private $query = NULL;
        private $table = NULL;
        private $filter = NULL;
        private $order = NULL;
        private $limit = NULL;
        
        public function __construct($table = '') {
            $this->table = $table;
            $this->query = 'SELECT * FROM '.$this->table;
        }
        
        public function set_query($query) {
            $this->query = $query;
        }
        
        public function set_table($table) {
            $this->table = $table;
            $this->query = 'SELECT * FROM '.$this->table;
        }
                
        public function get_result() {
            $query = $this->query . $this->filter . $this->order . $this->limit;
            return mysql_query($query);
        }
        
        public function get_field($field, $id) {
            $query = 'SELECT * FROM '.$this->table.' WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_result($result, 0, $field);
        }
        
        /**
         * Devuelve el contenido de una fila especifica.
         * @param $id El codigo de la fila
         * @return array Un array asociativo sql
         */
        public function get_row($id) {
            $query = 'SELECT * FROM '.$this->table.' WHERE codigo = '.$id;
            $result = mysql_query($query);
            return mysql_fetch_row($result);
        }
        
        /**
         * Devuelve la cantidad de filas.
         * @return int
         */
        public function get_count() {
            $query = $this->query.' '.$this->filter;
            $result = mysql_query($query);
            if (!$result || mysql_num_rows($result) < 1) {
                return 0;
            }
            return mysql_num_rows($result);
        }
        
        /**
         * Resetea las condiciones de busqueda.
         */
        public function reset_filter() {
            $this->filter = NULL;
        }
        
        /**
         * Aplica un filtro de busqueda.
         * @param $field La columna a filtrar.
         * @param $value El valor buscado de dicha columna.
         */ 
        public function set_filter($field, $value) {
            $this->init_filter();
            $this->filter .= ' '.$field.' LIKE "%'.$value.'%" ';
        }
        
        /**
         * Aplica un filtro de busqueda y su condicion.
         * @param $field La columna a filtrar.
         * @param $condition El condicional de la busqueda.
         * @param $value El valor buscado de dicha columna.
         */ 
        public function set_conditional_filter($field, $condition, $value) {
            $this->init_filter();
            $this->filter .= ' '.$field.' '.$condition.' '.$value.' ';
        }
                
        /**
         * Aplica un filtro de busqueda de una tabla foranea.
         * @param $field La columna a filtrar.
         * @param $value El valor buscado de dicha columna.
         * @param $foreign_field La columna de la tabla foranea.
         * @param $foreign_table El nombre de la tabla foranea.
         */ 
        public function set_foreign_filter($field, $value, $foreign_field, $foreign_table) {
            $this->init_filter();
            $this->filter .= $field.' IN (SELECT codigo FROM '.$foreign_table.' WHERE '.$foreign_field.' LIKE "%'.$value.'%") ';
        }
        
        /**
         * Indica el orden de los registros de la tabla.
         * @param $field La columna a ordenar.
         * @param $order El orden de la columna (ASC o DESC).
         */ 
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

        public function init_filter() {
            if (is_null($this->filter)) {
                $this->filter = ' WHERE ';
            }
            else {
                $this->filter .= ' AND ';
            }
        }
        
        public function get_filter() {
            return $this->filter;
        }
        
        public function get_table() {
            return $this->table;
        }
        
        public function exists($id) {
            $query = 'SELECT * FROM '.$this->table.' WHERE codigo = '.$id;
            $result = mysql_query($query);
            if (!$result || mysql_num_rows($result) < 1) {
                return FALSE;
            }
            return TRUE;
        }
        
        public function current_id() {
            $query = "SELECT MAX(codigo) FROM ".$this->table;
            $result = mysql_query($query);
            return mysql_result($result, 0, 0);
        }
        
        public function add() {}
        
        public function edit() {}
        
        public function delete() {}
        
    }

?>