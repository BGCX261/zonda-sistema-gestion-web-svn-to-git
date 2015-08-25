<?php
    
    print '<form class="formulario_busqueda" action="" method="GET">';
                
    print '<input type="hidden" id="inicio" name="inicio" value="'.$_REQUEST['inicio'].'" />';
    print '<input type="hidden" id="cantidad" name="cantidad" value="'.$_REQUEST['cantidad'].'" />';
    print '<input type="hidden" id="orden" name="orden" value="'.$_REQUEST['orden'].'" />';
    print '<input type="hidden" id="direccion" name="direccion" value="'.$_REQUEST['direccion'].'" />';
    
    if (isset($_REQUEST['codigo'])) {
        print '<input type="hidden" id="codigo" name="codigo" value="'.$_REQUEST['codigo'].'" />';
    }

    print '<input type="hidden" name="include" value="'.$_REQUEST['include'].'" />';
    print '<input type="hidden" name="form" value="'.$_REQUEST['form'].'" />';

    print '<p><label>Filtro:</label>
        <select id="'.$this->NombreFiltro.'" name="campo" class="text ui-widget-content ui-corner-all">';

    foreach($this->Campos as $Campo) {
        if ($Campo['busqueda'] != 0) {
            print '<option value="'.$Campo['nombre'].'"';
            if (isset($_REQUEST['campo']) && $_REQUEST['campo'] == $Campo['nombre']) {
                print ' selected="selected"';
            }
            print '>'.$Campo['alias'].'</option>';
        }
    }

    print '</select>
        <input type="text" id="'.$this->NombreFiltro.'_value" name="busqueda" class="text ui-widget-content ui-corner-all" ';
    if (isset($_REQUEST['busqueda'])) {
        print ' value="'.$_REQUEST['busqueda'].'"';
    }

    print '/></p>';

    print '<p><label>Orden:</label>
        <select name="orden" class="text ui-widget-content ui-corner-all">';

    foreach($this->Campos as $Campo) {
        print '<option value="'.$Campo['nombre'].'"';
        if (isset($_REQUEST['orden']) && $_REQUEST['orden'] == $Campo['nombre']) {
            print ' selected="selected"';
        }
        print '>'.$Campo['alias'].'</option>';
    }

    print '</select>
        <select name="direccion" class="text ui-widget-content ui-corner-all">';

    print '<option value="ASC"';
    if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'ASC') {
        print ' selected="selected"';
    }
    print '>Ascendente</option>';
    print '<option value="DESC"';
    if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'DESC') {
        print ' selected="selected"';
    }
    print '>Descendente</option>';

    print '</select></p>';

    print '<p><label>Cantidad:</label>
        <select name="cantidad" class="text ui-widget-content ui-corner-all">';

    print '<option value="10"';
    if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '10') {
        print ' selected="selected"';
    }
    print '>10</option>';
    print '<option value="25"';
    if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '25') {
        print ' selected="selected"';
    }
    print '>25</option>';
    print '<option value="50"';
    if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '50') {
        print ' selected="selected"';
    }
    print '>50</option>';
    print '<option value="100"';
    if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '100') {
        print ' selected="selected"';
    }
    print '>100</option>';
    print '<option value="1000"';
    if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '1000') {
        print ' selected="selected"';
    }
    print '>1000</option>';

    print '</select></p>';

    print '<input type="submit" value="Aplicar filtros" class="ui-button ui-widget-content ui-corner-all" />';

    $Registros = $this->CantidadRegistros;
    
    include_once("include/paginador.php");

    print '</form>';
    
?>