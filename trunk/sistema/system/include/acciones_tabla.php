<?php

    class AccionesTabla {
        
        private $include = NULL;
        private $form = NULL;
        private $id = NULL;
        private $uri = NULL;

        public function __construct($include, $form) {
            $this->include = $include;
            $this->form = $form;
            $uri = explode("?", $_SERVER['REQUEST_URI']);
            $this->uri = $uri[1];
        }
        
        public function set_code($id) {
            $this->id = $id;
        }
        
        protected function get_code() {
            return $this->id;
        }
        
        protected function get_uri() {
            return $this->uri;
        }
        
        public function show() {
            return '<div class="acciones-tabla">
                        <a href="?include='.$this->include.'&form='.$this->form.'&codigo='.$this->id.'" class="boton-acciones accion-tabla-edicion"></a>
                        <a href="?include='.$this->include.'&form='.$this->form.'&type=clonar&codigo='.$this->id.'" class="boton-acciones accion-tabla-clonar"></a>
                        <a href="?'.$this->uri.'&action=baja&codigo='.$this->id.'" class="boton-acciones accion-tabla-borrar"></a>
                    </div>';
        }
        
    }

?>