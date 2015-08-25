<div id="tabla-datos-show-fields">
    <ul>
        <?php
            foreach ($campos as $campo) {
                print '<li><input type="checkbox" name="'.strtolower($campo['nombre']).'" checked="checked">'.$campo['titulo'].'</li>';
            }
        ?>
    </ul>
    <div id="boton-ver"><a></a></div>
</div>