<?php
    /*
     * ORDEN DE TABLA
     * permite agregar dos combos para ordenar los campos de una tabla
     * 
     * requiere el array $Campos:
     *      $Campos = array(
     *          array(
     *              'nombre' => ''
     *              'alias'  => '' 
     *          )
     *      )
     */
?>

<label>Orden:</label>

<select name="orden" class="text ui-widget-content ui-corner-all">
    <?php
        foreach($Campos as $Campo) {
            print '<option value="'.$Campo['nombre'].'"';
            if (isset($_REQUEST['orden']) && $_REQUEST['orden'] == $Campo['nombre'])
                print ' selected="selected"';
            print '>'.$Campo['alias'].'</option>';
        }
    ?>
</select>

<select name="direccion" class="text ui-widget-content ui-corner-all">
    <option value="ASC" <?php
        if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'ASC') {
            print ' selected="selected"';
        }
    ?> >Ascendente</option>
    <option value="DESC" <?php
        if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'DESC') {
            print ' selected="selected"';
        }
    ?> >Descendente</option>
</select>
