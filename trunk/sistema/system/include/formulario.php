<?php

    class Formulario {
        
        private $include = NULL;
        private $form = NULL;
        private $action = NULL;
        private $parameters = NULL;
        private $uri = NULL;
        private $method = NULL;
        
        public function __construct(/*$include = '', $form = '', */$action = '') {
            /*$this->include = $include;
            $this->form = $form;*/
            $this->action = $action;
            $this->method = 'POST';
            $this->parameters = array();
        }
        
        public function set_include($include) {
            $this->include = $include;
        }
        
        public function set_form($form) {
            $this->form = $form;
        }
        
        public function set_action($action) {
            $this->action = $action;
        }
        
        public function set_param($param, $value) {
            $this->parameters[] = array('name' => $param, 'value' => $value);
        }
        
        public function set_action_uri($uri) {
            $this->uri = $uri;
        }
        
        public function set_method($method) {
            $this->method = $method;
        }
        
        public function open() {
            /*if (!isset($this->uri) || empty($this->uri)) {
                $this->set_action_param($this->include, 'include');
                $this->set_action_param($this->form, 'form');
                $this->set_action_param($this->action, 'action');
                $this->set_action_param($this->param);
            }
            print '<form class="formulario" method="'.$this->method.'" enctype="multipart/form-data" action="'.$this->uri.'">';*/
            print '<form class="formulario" method="'.$this->method.'" enctype="multipart/form-data" action="'.$this->uri.'">';
            /*if (!isset($this->uri) || empty($this->uri)) {
                $this->set_action_param($this->include, 'include');
                $this->set_action_param($this->form, 'form');
                $this->set_action_param($this->action, 'action');
                $this->set_action_param($this->param);
            }*/
            $this->set_action_parameters();
        }
        
        public function close() {
            print '</form>';
        }
        
        private function set_action_param($param, $name = '') {
            if (isset($param) && !empty($param)) {
                /*if (!empty($this->uri)) {
                    $this->uri .= '&';
                }
                else {
                    $this->uri = '?';
                }*/
                /*if (!empty($name)) {
                    $this->uri .= $name.'='.$param;
                }
                else {
                    $this->uri .= $param;
                }*/
                $campo = new CampoOculto($name, $param);
                $campo->show();
            }
        }
        
        private function set_action_parameters() {
            if (isset($this->parameters) && sizeof($this->parameters) > 0) {
                foreach ($this->parameters as $param) {
                    $campo = new CampoOculto($param['name'], $param['value']);
                    $campo->show();
                }
                
            }
        }
        
    }

?>