<?php

    class CampoTexto extends Campo {
        
        private $text = '';

        public function __construct($name, $label) {
            parent::__construct($name, '', $label, '');
        }
        
        public function set_text($text) {
            $this->text = $text;
        }
        
        public function show() {
            print '<label>'.parent::get_label().'</label>';
            print '<textarea name="'.parent::get_name().'" class="campo campo-texto-grande ui-widget-content ui-corner-all" '.parent::get_required().' '.parent::get_readonly().'>'.$this->text.'</textarea>';
        }
        
    }

?>