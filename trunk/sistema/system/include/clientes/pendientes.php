<?php
    
    class ClientesPendientes extends TableHandler {
        
        public function __construct() {
            parent::__construct('clientes_pendientes');
            parent::set_query("SELECT codigo, razon, nombre, domicilio, telefono, provincia, localidad, contacto, pagina, correo FROM clientes_pendientes");
        }
        
    }

?>