<?php
    
    class Sesion {
        
        public function login() {
            $query = "SELECT * FROM usuarios WHERE apodo = '".$_REQUEST['grovi']."' AND clave = MD5('".$_REQUEST['redemp']."')";
            $result = mysql_query($query);
            if ($result && mysql_num_rows($result) > 0) {
                $row = mysql_fetch_array($result);
                setcookie("session_haybale", $row[0], time() + 604800, "/");
                setcookie("session_harvest", $row[3], time() + 604800, "/");
                return TRUE;
            }
            return FALSE;
        }
        
        public function logout() {
            setcookie("session_haybale", "xxx", time() - 3600, "/");
            setcookie("session_harvest", "xxx", time() - 3600, "/");
        }
        
        public function is_logged() {
            return isset($_COOKIE["session_haybale"]);
        }
        
        public function get_user() {
            if ($this->is_logged()) {
                $result = mysql_query("SELECT * FROM usuarios WHERE codigo = ".$_COOKIE["session_haybale"]." AND clave = '".$_COOKIE["session_harvest"]."'");
                return mysql_fetch_array($result);
            }
            return NULL;
        }
        
        public function get_user_id() {
            if ($this->is_logged()) {
                return $_COOKIE["session_haybale"];
            }
            return NULL;
        }
        
        public function get_user_name() {
            if ($this->is_logged()) {
                $result = mysql_query("SELECT apodo FROM usuarios WHERE codigo = ".$_COOKIE["session_haybale"]." AND clave = '".$_COOKIE["session_harvest"]."'");
                return mysql_fetch_field($result, 0);
            };
            return NULL;
        }
        
        public function get_style_id() {
            if ($this->is_logged()) {
                $result = mysql_query("SELECT estilo FROM usuarios_opciones WHERE usuario = ".$this->get_user_id());
                return mysql_fetch_field($result);
            }
            return NULL;
        }
        
        public function get_style() {
            if ($this->is_logged()) {
                return $_COOKIE['style'];
            }
            return NULL;
        }
        
        public function set_style() {
            if ($this->is_logged()) {
                return mysql_query("UPDATE usuarios_opciones SET estilo = ".$_REQUEST['estilo']." WHERE usuario = ".$this->get_user_id());
            }
            return NULL;
        }
        
        public function get_style_link() {
            if ($this->is_logged()) {
                $query = "SELECT usuarios_opciones.estilo, estilos.ruta, estilos.jquery FROM usuarios_opciones, estilos WHERE usuarios_opciones.estilo = estilos.codigo AND usuarios_opciones.usuario = ".$this->get_user_id();
                $result = mysql_query($query);
                if ($result && mysql_numrows($result) > 0) {
                    $style = mysql_fetch_row($result);
                    print '<link href="styles/'.$style[1].'/style.css" rel="stylesheet" type="text/css">';
                    print '<link href="styles/'.$style[1].'/controls.css" rel="stylesheet" type="text/css">';
                    print '<link href="scripts/lib/jquery/css/'.$style[2].'/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css">';
                    setcookie('style', $style[1], time() + 604800, '/');
                }
                else {
                    mysql_query("INSERT INTO usuarios_opciones (usuario, estilo) VALUES (".$this->get_user_id().", 1)");
                    print '<link href="styles/original/style.css" rel="stylesheet" type="text/css">';
                    print '<link href="styles/original/controls.css" rel="stylesheet" type="text/css">';
                    print '<link href="scripts/lib/jquery/css/ui-darkness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css">';
                    setcookie('style', 'original', time() + 604800, '/');
                }
            }
            return NULL;
        }
        
        public function log() {
            return mysql_query("INSERT INTO usuarios_registro ( usuario, fecha, ip, session ) VALUES ( ".$this->get_user_id().", now(), '".$this->get_ip()."', '".session_id()."' )");
        }
        
        public function verify() {
            return mysql_query("SELECT * FROM usuarios_opciones WHERE usuario = ".$this->get_user_id()." AND fecha < now() AND ip = '".$this->get_user_id()."' AND session = '".session_id()."'");
        }
        
        public function get_ip() {
            $ip = "0.0.0.0";
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            if (!empty($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
        
    }

?>