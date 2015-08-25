<?php

    class Imagen {
        
        private $image = NULL;
        private $class = 'imagen imagen-mediana';

        public function __construct($image) {
            $this->image = $image;
        }
        
        public function set_class($class) {
            $this->class = $class;
        }

        public function show() {
            print '<img class="'.$this->class.'" src="'.(empty($this->image) ? 'images/sin-imagen.png' : $this->image).'" />';
        }
        
    }

?>