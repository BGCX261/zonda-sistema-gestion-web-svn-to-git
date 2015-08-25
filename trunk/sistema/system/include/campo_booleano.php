<?php

    class CampoBooleano extends Campo {
        
        public function __construct($name, $value, $label) {
            parent::__construct($name, $value, $label, '');
        }
        
        public function show() {
            $val = '';
            if (parent::get_value()) {
                $val = 'checked="checked';
            }
            print '<p><input type="checkbox" name="'.parent::get_name().'" '.$val.'" '.parent::get_required().' '.parent::get_readonly().' '.parent::get_disabled().' '.parent::get_parameters().' />'.parent::get_label().'</p>';
        }
        
    }

?>