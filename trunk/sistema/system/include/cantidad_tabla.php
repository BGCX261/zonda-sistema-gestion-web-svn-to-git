<?php
    /*
     * CANTIDAD DE REGISTROS DE TABLA
     * permite seleccionar la cantidad de campos mostrados de una tabla
     */
?>

<label>Cantidad:</label>
<select name="cantidad" class="text ui-widget-content ui-corner-all">
    <option value="10" <?php
        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '10') {
            print 'selected="selected"';
        }
    ?> >10</option>
    <option value="25" <?php
        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '25') {
            print 'selected="selected"';
        }
    ?> >25</option>
    <option value="50" <?php
        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '50') {
            print 'selected="selected"';
        }
    ?> >50</option>
    <option value="100" <?php
        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '100') {
            print 'selected="selected"';
        }
    ?> >100</option>
    <option value="1000" <?php
        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '1000') {
            print 'selected="selected"';
        }
    ?> >1000</option>
</select>
