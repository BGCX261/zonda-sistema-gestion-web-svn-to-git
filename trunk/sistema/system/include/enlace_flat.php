<?php

    class EnlaceFlat extends Enlace {
        
        public function __construct($name, $value, $href, $class) {
            parent::__construct($name, $value, $href);
            parent::set_class("boton boton-flat ".$class);
        }
        
    }

?>