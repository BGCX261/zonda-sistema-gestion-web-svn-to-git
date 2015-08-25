<?php
    /**
     * Clase ImageHandler
     *
     * @author Juan Manuel Scarciofolo
     * @license http://www.gnu.org/copyleft/gpl.html
     * @since 22/12/2014
     */
    class ImageHandler {
        
        private $path = NULL;
        private $name = NULL;

        public function __construct($path) {
            $this->path = $path;
        }
        
        public function load() {
            if (!isset($_FILES["imagen"]) || !is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
                return FALSE;
            }
            $this->name = $this->path.$this->get_prefix().$_FILES["imagen"]["name"];
            if (copy($_FILES["imagen"]["tmp_name"], $this->name)) {
                return $this->name;
            }
            return FALSE;
        }
        
        public function get_path() {
            return $this->path;
        }
        
        public function get_name() {
            return $this->name;
        }
        
        public function get_prefix() {
            return date("YmdHis_");
        }
        
    }
?>