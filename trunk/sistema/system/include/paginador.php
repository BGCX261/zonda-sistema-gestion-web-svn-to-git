<?php
    
    class Paginador {
        
        private $total = 0;
        private $interval = 0;
        private $url = NULL;


        public function set_total($value) {
            $this->total = $value;
        }
        
        public function set_interval($value) {
            $this->interval = $value;
        }
        
        public function set_url($url) {
            $this->url = $url;
        }

        public function show() {
            if ($this->interval <= 0 || $this->total <= 0) {
                return;
            }
            if ($this->interval < $this->total) {
                print '<div id="paginador"><ul>';
                for ($index = 0, $i = 1; $index < $this->total; $index += $this->interval, $i++) {
                    print '<li><a href="'.$this->set_url_inicio($index).'"'.($this->get_url_incio() == $index ? ' class="selected"' : '').'>'.$i.'</a></li>';
                }
                print '</ul></div>';
            }
        }
        
        private function set_url_inicio($value) {
            $url = split("inicio=[0-9]+", $this->url);
            return $url[0].'inicio='.$value.$url[1];
        }
        
        private function get_url_incio() {
            $url = split("inicio=", $this->url);
            $inicio = split("&", $url[1]);
            return $inicio[0];
        }
        
    }

?>