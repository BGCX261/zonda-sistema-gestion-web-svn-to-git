<?php

    class BotonFlat extends Boton {
        
        public function __construct($name, $value, $class) {
            parent::__construct($name, $value);
            parent::set_class("boton-flat ".$class);
        }
        
        public function show() {
            print '<button id="'.parent::get_name().'" name="'.parent::get_name().'" class="'.parent::get_class().'">'.parent::get_value().'</button>';
        }
        
    }

?>