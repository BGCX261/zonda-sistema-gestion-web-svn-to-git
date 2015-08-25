<?php
    
    print '<table class="ui-widget tabla-datos" cellpadding="0" cellspacing="0">';
    
    print '<thead class="ui-widget-header">
                <tr>
                    <th class="header"></th>
                    <th class="header">CODIGO</th>
                    <th class="header">DESCRIPION</th>
                    <th class="header">PRECIO</th>
                    <th class="header">ALICUOTA</th>
                    <th class="header">CANTIDAD</th>
                </tr>
            </thead>';
    
    print '<tbody>';
    
    $Toggle = 0;
    
    while ($Row = mysql_fetch_array($Result)) {
        print '<tr class="';
        $Toggle++ % 2 == 0 ? print "even" : print "odd";
        print '">';
        print '<td class="selector-articulo">';
        print '<input type="checkbox" name="articulos[]" value="'.$Row[0].'" />';
        print '</td>';
        print '<td>'.$Row[0].'</td>';
        print '<td>'.$Row[1].'</td>';
        print '<td align="right" class="precio-articulo">'.$Row[2].'</td>';
        print '<td align="right" class="alicuota-articulo">'.$Row[3].'</td>';
        print '<td class="cantidad-articulo" align="center">';
        print '<input type="text" name="cantidades[]" class="input-tabla" value="0" />';
        print '</td>';
        print '</tr>';
    }

    print '</tbody>';

    print '</table>';

?>

<script> 
    
    /*
     * CALCULAR EL TOTAL DE LA FACTURA :
     */
    $("input[name='cantidades[]']").change(
        function() {
            if (isNaN($(this).val()) || $(this).val() < 0) {
                alert("No se ingresó un número válido!");
                $(this).val(0);
            }
            if ($(this).val() != 0) {
                $(this).parent().parent().children("td.selector-articulo").children("input[type=checkbox]").prop("checked", true);
            }
            else {
                $(this).parent().parent().children("td.selector-articulo").children("input[type=checkbox]").prop("checked", false);
            }
            var subtotal = 0;
            var iva = 0;
            $("input[name='cantidades[]']").each(
                function() {
                    var cantidad = Number($(this).val());
                    var precio = Number($(this).parent().parent().children("td.precio-articulo").text());
                    var alicuota = Number($(this).parent().parent().children("td.alicuota-articulo").text());
                    var monto = cantidad * precio;
                    subtotal = subtotal + monto;
                    iva = iva + monto * alicuota / 100;
                }
            );
            if ($("input[name='iva[" + $("#factura").val() + "]']").val() == 1) {
                if ($("input[name='discrimina[" + $("#factura").val() + "]']").val() == 1) {
                    $("#subtotal-factura").text(subtotal.toFixed(2));
                    $("#iva-factura").text(iva.toFixed(2));
                    $("#total-factura").text((subtotal + iva).toFixed(2));
                }
                else  {
                    $("#subtotal-factura").text((subtotal + iva).toFixed(2));
                    $("#iva-factura").text(iva.toFixed(2));
                    $("#total-factura").text((subtotal + iva).toFixed(2));
                }
            }
            else {
                $("#subtotal-factura").text(subtotal.toFixed(2));
                $("#iva-factura").text("0.00");
                $("#total-factura").text(subtotal.toFixed(2));
                iva = 0;
            }
            $("#iva").val(iva.toFixed(2));
            $("#monto").val((subtotal + iva).toFixed(2));
        }
    );
    
    /*
     * RECARGAR LA LISTA DE ARTICULOS SEGUN LA LISTA DE PRECIOS :
     */
    $("#lista").change(
        function() {
            window.location.href = "?include=ventas&form=form_venta&<?php if (isset($_REQUEST['codigo'])) print 'codigo='.$_REQUEST['codigo'].'&'; ?>cliente=" + $("#cliente").val() + "&lista=" + $(this).val() + "&factura=" + $("#factura").val() + "&condicion=" + $("#condicion").val() + "&fondo=" + $("#fondo").val();
        }
    );
    
    /*
     * RECALCULAR LOS TOTALES SEGUN EL TIPO DE FACTURA SELECCIONADA :
     */
    $("#factura").change(
        function() {
            $("input[name='cantidades[]']").trigger("change");
        }
    );
    
    /*
     * SI NO SE SELECCIONA EL ARTICULO LA CANTIDAD VUELVE A CERO :
     */
    $("input[name='articulos[]']").change(
        function() {
            if (!$(this).prop("checked")) {
                $(this).parent().parent().children("td.cantidad-articulo").children("input[type=text]").val('0');
            }
            else {
                if ($(this).parent().parent().children("td.cantidad-articulo").children("input[type=text]").val() == 0) {
                    $(this).parent().parent().children("td.cantidad-articulo").children("input[type=text]").val('1');
                }
            }
            $("input[name='cantidades[]']").trigger("change");
        }
    );
    
    $("input[name='cantidades[]']").trigger("change");
    
</script>