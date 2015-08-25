<?php

    class EncabezadoTabla {
        
        function show($array) {
            print '<thead class="ui-widget-header"><tr>';
            foreach($array as $campo) {
                print '<th class="header" field="'.strtolower($campo['nombre']).'" width="'.$campo['ancho_celda'].'%" align="'.$campo['alineacion'].'">'.$campo['titulo'].'</th>';
            }
            print '<th></th></tr></thead>';
        }
        
    }

?>