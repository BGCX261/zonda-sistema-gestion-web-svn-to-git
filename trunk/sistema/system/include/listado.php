<?php
    class Listado {
        
        var $Titulo = '';
        //el titulo que se muestra en el listado
        
        var $ConsultaRegistros = '';
        //la consulta que se utiliza para saber la cantidad de registros
        
        var $Consulta = '';
        //la consulta que se utiliza para traer los registros
        
        var $Campos = array();
        //un array de arrays que contiene la informacion de los campos del listado
        //formato del array: [ titulo, nombre, alias, alineacion, ancho_celda ]
        
        var $NombreTabla = '';
        var $NombreFiltro = '';
        
        var $Funciones = '';
        //las funcionalidades que mostrara la tabla al final de la fila
        //generalmente un arreglo de enlaces para llamar a funciones sobre los registros
        //el campo oculto codigo_registro contiene la referencia al codigo de la fila
        
        private $LISTADO = 0;
        private $LISTADO_IMAGENES = 1;
        private $IMAGENES = 2;
        //tipo de listados disponibles
        
        var $BotonNuevoRegistro = '';
        
        var $CantidadRegistros = 0;
        //cantidad de registros en la consulta
        
        function Mostrar($TipoListado = 0) {
        
            print '<h1>'.$this->Titulo.'</h1>';
            
            if (!isset($_REQUEST['impresion'])) { 
                print $this->BotonNuevoRegistro;
            }
            
            $query = $this->ConsultaRegistros;
            
            $query .= $this->AgregarCondiciones();
            
            $return = mysql_query($query);
            
            $this->CantidadRegistros = mysql_num_rows($return);
            
            if (!isset($_REQUEST['impresion'])) {
                print '<input type="hidden" id="registros" value="'.$this->CantidadRegistros.'" />';
            }
            
            $query = $this->Consulta;
            
            $query .= $this->AgregarCondiciones();
            
            $query .= $this->AgregarPaginado();
            
            if (!isset($_REQUEST['impresion'])) { 
                include_once("include/form_listado.php");
            }
            
            $this->MostrarCantidadRegistros($this->CantidadRegistros);
            
            switch ($TipoListado) {

                case $this->LISTADO:
                    $this->MostrarListadoTabla();
                    break;
                
                case $this->LISTADO_IMAGENES:
                    $this->MostrarListadoImagenes();
                    break;
                
                case $this->IMAGENES:
                    $this->MostrarImagenes();
                    break;

            }
            
        }
        
        private function AgregarCondiciones() {
            $query = "";
            if (isset($_REQUEST['campo']) && !empty($_REQUEST['campo']) && isset($_REQUEST['busqueda']) && !empty($_REQUEST['busqueda'])) {
                if (strstr($query, 'WHERE'))
                    $query .= " AND ";
                else
                    $query .= " WHERE ";
                $query .= $_REQUEST['campo']." LIKE '".$_REQUEST['busqueda']."%'";
            }
            return $query;
        }
        
        private function AgregarPaginado() {
            $query = "";
            if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
                $query .= " ORDER BY ".$_REQUEST['orden']." ".$_REQUEST['direccion'];
                $query .= " LIMIT ".$_REQUEST['inicio'].", ".$_REQUEST['cantidad'];
            }
            return $query;
        }
        
        private function MostrarCantidadRegistros() {
            $Plural = '';
            $Cantidad = $this->CantidadRegistros;
            if ($this->CantidadRegistros > 1) {
                $Plural = 's';
            }
            if ($this->CantidadRegistros < 1) {
                $Cantidad = 'Ningún';
            }
            print '<label class="info_tabla">'.$Cantidad.' registro'.$Plural.' encontrado'.$Plural.'</label></p>';
        }
        
        private function MostrarListadoTabla() {
            print '<table id="'.$this->NombreTabla.'" class="ui-widget tabla-datos" cellpadding="0" cellspacing="0">';
            print '<thead class="ui-widget-header">
                    <tr>';
                    
            foreach($this->Campos as $Campo) {
                print '<th class="header" width="'.$Campo['ancho_celda'].'%" align="'.$Campo['alineacion'].'">'.$Campo['titulo'].'</th>';
            }
            
            if (isset($this->Funciones) && !empty($this->Funciones)) {
                print '<th class="header" width="10%"></th>';
            }
            
            print '</tr></thead><tbody>';
            
            if ($this->CantidadRegistros > 0) {
                $query = $this->Consulta;
                $query .= $this->AgregarCondiciones();
                $query .= $this->AgregarPaginado();
                
                $return = mysql_query($query);
                
                print '<input type="hidden" id="registros" value="'.$this->CantidadRegistros.'" />';
                
                $Toggle = 0;
      
                while ($Row = mysql_fetch_row($return)) {
                    print '<tr class="';
                    $Toggle++ % 2 == 0 ? print "even" : print "odd";
                    print '">';
                    $i = 0;
                    foreach ($Row as $Data) {
                        print '<td';
                        print ' align="'.$this->Campos[$i++]['alineacion'].'"';
                        print '>'.$Data.'</td>';
                    }

                    if (!isset($_REQUEST['impresion'])) { 
                        if (isset($this->Funciones) && !empty($this->Funciones)) {
                            print '<td class="funciones-tabla" align="right">';
                            foreach ($this->Funciones as $Funcion) {
                                print '<a href="'.$Funcion['referencia'].'&codigo='.intval($Row[0]).'" class="accion-tabla"';
                                if (isset($Funcion['accion'])) 
                                    print ' onclick="'.$Funcion['accion'].'"';
                                print '>'.$Funcion['nombre'].'</a>';
                            }
                            print '</td>';
                        }
                    }
                    
                    print '</tr>';
                }
            }
            print '</tbody></table>';
        }
        
        private function MostrarListadoImagenes() {
            print 'No implementado aun!';
        }
        
        private function MostrarImagenes() {
            print 'No implementado aun!';
        }
        
    }
?>