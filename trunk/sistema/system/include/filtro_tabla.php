<?php
    /*
     * FILTRO DE TABLA
     * permite agregar un combo y una caja de texto para filtrar los campos de una tabla
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

<label>Filtro:</label>
<select name="campo" class="text ui-widget-content ui-corner-all">
    <?php
        foreach($Campos as $Campo) {
            print '<option value="'.$Campo['nombre'].'"';
            if (isset($_REQUEST['campo']) && $_REQUEST['campo'] == $Campo['nombre']) {
                print ' selected="selected"';
            }
            print '>'.$Campo['alias'].'</option>';
        }
    ?>
</select>
<input type="text" name="busqueda" class="text ui-widget-content ui-corner-all" <?php
    if (isset($_REQUEST['busqueda'])) {
        print ' value="'.$_REQUEST['busqueda'].'"';
    }
?> />