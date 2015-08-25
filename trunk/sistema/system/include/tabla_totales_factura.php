<?php
    include_once("lista_articulos.php");
    include_once("tabla_detalle_factura.php");
    include_once("formatter.php");
    
    session_start();
    
    if (isset($_SESSION["lista_articulos"])) {
?>
<table class="ui-widget tabla-totales">
        <tbody>
            <tr class="even">
                <td>Importe:</td>
                <td field="importe" align="right"><?php print Formatter::number_format($_SESSION["lista_articulos"]->get_total()); ?></td>
            </tr>
            <tr class="odd">
                <td>IVA:</td>
                <td field="iva" align="right"><?php print Formatter::number_format($_SESSION["lista_articulos"]->get_total_iva()); ?></td>
            </tr>
            <tr class="even">
                <td class="total">Total:</td>
                <td field="total" align="right" class="total"><?php print Formatter::number_format($_SESSION["lista_articulos"]->get_total() + $_SESSION["lista_articulos"]->get_total_iva()); ?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>