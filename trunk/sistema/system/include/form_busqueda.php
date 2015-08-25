<div id="tabla-datos-search-form">
    <form class="formulario_busqueda" action="" method="GET">

        <input type="hidden" name="include" value="<?php print $_REQUEST['include']; ?>" />
        <input type="hidden" name="form" value="<?php print $_REQUEST['form']; ?>" />
        
        <?php if (isset($_REQUEST['codigo'])) { ?>
            <input type="hidden" id="codigo" name="codigo" value="<?php print $_REQUEST['codigo']; ?>" />
        <?php } ?>
        <?php if (isset($_REQUEST['lista'])) { ?>
            <input type="hidden" id="lista" name="lista" value="<?php print $_REQUEST['lista']; ?>" />
        <?php } ?>
        <p>
            <label>Filtro:</label>
            <select name="campo" class="">
                <?php
                    foreach ($campos as $campo) {
                        if (!empty($campo['alias'])) {
                            print '<option value="' . $campo['nombre'] . '"';
                            if (isset($_REQUEST['campo']) && $_REQUEST['campo'] == $campo['nombre']) {
                                print ' selected="selected"';
                            }
                            print '>' . $campo['alias'] . '</option>';
                        }
                    }
                ?>
            </select>
            <input type="text" name="busqueda" class="campo campo-flat campo-min" 
                <?php
                    if (isset($_REQUEST['busqueda'])) {
                        print ' value="'.$_REQUEST['busqueda'].'"';
                    }
                ?>
            />
        </p>
        <p>
            <label>Orden:</label>
            <select name="orden" class="text ui-widget-content ui-corner-all">
                <?php
                    foreach ($campos as $campo) {
                        if (!empty($campo['alias'])) {
                            print '<option value="' . $campo['nombre'] . '"';
                            if (isset($_REQUEST['orden']) && $_REQUEST['orden'] == $campo['nombre']) {
                                print ' selected="selected"';
                            }
                            print '>' . $campo['alias'] . '</option>';
                        }
                    }
                ?>
            </select>
            <select name="direccion" class="text ui-widget-content ui-corner-all">
                <option value="ASC"
                    <?php
                        if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'ASC') {
                            print ' selected="selected"';
                        }
                    ?>
                >Ascendente</option>
                <option value="DESC"
                    <?php
                        if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'DESC') {
                            print ' selected="selected"';
                        }
                    ?>
                >Descendente</option>
            </select>
        </p>
        
        <input type="hidden" id="inicio" name="inicio" value="<?php print $_REQUEST['inicio']; ?>" />
        
        <p>
            <label>Cantidad:</label>
            <select name="cantidad" class="text ui-widget-content ui-corner-all">
                <option value="10"
                    <?php
                        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '10') {
                            print ' selected="selected"';
                        }
                    ?>
                >10</option>
                <option value="25"
                    <?php
                        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '25') {
                            print ' selected="selected"';
                        }
                    ?>
                >25</option>
                <option value="50"
                    <?php
                        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '50') {
                            print ' selected="selected"';
                        }
                    ?>
                >50</option>
                <option value="100"
                    <?php
                        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '100') {
                            print ' selected="selected"';
                        }
                    ?>
                >100</option>
                <option value="1000"
                    <?php
                        if (isset($_REQUEST['cantidad']) && $_REQUEST['cantidad'] == '1000') {
                            print ' selected="selected"';
                        }
                    ?>
                >1000</option>
            </select>
        </p>

        <input type="submit" value="Aplicar filtros" class="boton boton-flat" />

        <div id="boton-buscar"><a></a></div>

    </form>
</div>

<script>
    $('input[type="submit"]').click(
        function() {
            $('[name="inicio"]').val(0);
        }
    );
</script>