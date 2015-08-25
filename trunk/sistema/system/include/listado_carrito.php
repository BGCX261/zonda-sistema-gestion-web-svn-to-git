
<table class="ui-widget tabla-datos" cellpadding="0" cellspacing="0">
    
    <thead class="ui-widget-header">
        <tr>
            <th class="header">CODIGO</th>
            <th class="header">DESCRIPION</th>
            <th class="header">PRECIO</th>
            <th class="header">ALICUOTA</th>
            <th class="header">CANTIDAD</th>
        </tr>
    </thead>

    <tbody>
        
        <?php

            $Toggle = 0;

            while ($Row = mysql_fetch_array($Result)) {
                print '<tr class="';
                $Toggle++ % 2 == 0 ? print "even" : print "odd";
                print '">';
                print '<td>'.$Row[0].'</td>';
                print '<td>'.$Row[1].'</td>';
                print '<td align="right" class="precio-articulo">'.$Row[2].'</td>';
                print '<td align="right" class="alicuota-articulo">'.$Row[3].'</td>';
                print '<td>';
                print '<form>';
                print '<input type="hidden" name="codigo_articulo" value="'.$Row[0].'" />';
                print '<input type="hidden" name="descripcion_articulo" value="'.$Row[1].'" />';
                print '<input type="hidden" name="precio_articulo" value="'.$Row[2].'" />';
                print '<input type="hidden" name="alicuota_articulo" value="'.$Row[3].'" />';
                print '<input type="text" name="cantidad_articulo" style="width: 30px" value="';
                if ($_SESSION["carrito"]->en_carrito($Row[0])) {
                    $art = $_SESSION["carrito"]->traer_articulo($Row[0]);
                    print $art['cantidad'];
                }
                else {
                    print '0';
                }
                print '" />';
                print '<input type="hidden" name="include" value="ventas" />';
                print '<input type="hidden" name="form" value="carrito" />';
                if (isset($_REQUEST['inicio'])) {
                    print '<input type="hidden" name="inicio" value="'.$_REQUEST['inicio'].'" />';
                }
                if (isset($_REQUEST['cantidad'])) {
                    print '<input type="hidden" name="cantidad" value="'.$_REQUEST['cantidad'].'" />';
                }
                if (isset($_REQUEST['orden'])) {
                    print '<input type="hidden" name="orden" value="'.$_REQUEST['orden'].'" />';
                }
                if (isset($_REQUEST['direccion'])) {
                    print '<input type="hidden" name="direccion" value="'.$_REQUEST['direccion'].'" />';
                }
                if (isset($_REQUEST['campo'])) {
                    print '<input type="hidden" name="campo" value="'.$_REQUEST['campo'].'" />';
                }
                if (isset($_REQUEST['busqueda'])) {
                    print '<input type="hidden" name="busqueda" value="'.$_REQUEST['busqueda'].'" />';
                }
                if (isset($_REQUEST['cliente'])) {
                    print '<input type="hidden" name="cliente" value="'.$_REQUEST['cliente'].'" />';
                }
                if (isset($_REQUEST['lista'])) {
                    print '<input type="hidden" name="lista" value="'.$_REQUEST['lista'].'" />';
                }
                print '<input type="submit" value="Agregar" />';
                print '</form>';
                
                print '</td>';
                print '</tr>';
            }
            
        ?>
        
    </tbody>

</table>