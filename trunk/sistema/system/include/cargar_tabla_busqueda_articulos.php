<?php
    include_once('conexion.php');
    include_once('articulos/articulos.php');
    
    Conexion::conectar();
    
    $articulos = new Articulos();
    $articulos->set_busqueda_filter($_REQUEST['busqueda']);
    
    $toggle = 0;
    $result = $articulos->get_articulos();
    
    print '<tbody>';
    while ($row = mysql_fetch_row($result)) {
        print '<tr class="'.($toggle++ % 2 == 0 ? 'even' : 'odd').'"><td name="codigo">'.$row[0].'</td><td name="descripcion">'.$row[1].'</td></tr>';
    }
    print '</tbody>';
?>