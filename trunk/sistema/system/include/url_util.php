<?php

    class UrlUtil {
        
        public function get_uri() {
            $url = '?';
            $url .= $this->get_param('include', TRUE);
            $url .= $this->get_param('form', FALSE);
            $url .= $this->get_param('type', FALSE);
            $url .= $this->get_param('inicio', FALSE);
            $url .= $this->get_param('cantidad', FALSE);
            $url .= $this->get_param('orden', FALSE);
            $url .= $this->get_param('direccion', FALSE);
            $url .= $this->get_param('campo', FALSE);
            $url .= $this->get_param('busqueda', FALSE);
            $url .= $this->get_param('lista', FALSE);
            $url .= $this->get_param('codigo', FALSE);
            $url .= $this->get_param('pedido', FALSE);
            return $url;
        }
        
        public static function uri_to_vars() {
            foreach ($_REQUEST as $key => $value) {
                $GLOBALS[$key] = $value;
            }
        }
        
        public function get_param($param, $new) {
            if(isset($_REQUEST[$param])) {
                return ($new ? '' : '&').$param.'='.$_REQUEST[$param];
            }
            return '';
        }
        
    }

?>