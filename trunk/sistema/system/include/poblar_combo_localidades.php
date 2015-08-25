<?php
    include('conexion.php');
    include('configuracion/localidades.php');
    Conexion::conectar();
    $localidades = new Localidades($_REQUEST['provincia']);
    $result = $localidades->get_localidades();
    while ($row = mysql_fetch_row($result)) {
        print '<option value="'.$row[0].'">'.$row[1].'</option>';
    }
?>