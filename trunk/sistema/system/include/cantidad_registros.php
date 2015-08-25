<?php

    $Plural = '';
    if ($Registros > 1)
        $Plural = 's';
    $Cantidad = $Registros;
    if ($Registros < 1)
        $Cantidad = 'Ningún';
    print '<p><label class="info_tabla">'.$Cantidad.' registro'.$Plural.' encontrado'.$Plural.'</label><br></p>';

?>