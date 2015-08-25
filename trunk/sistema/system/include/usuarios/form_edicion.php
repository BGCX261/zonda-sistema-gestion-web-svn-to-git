<?php
    $query = "SELECT * FROM usuarios WHERE codigo = ";
    
    if (isset($_REQUEST['codigo'])) {
        $query .= $_REQUEST['codigo'];
    }
    else {
        $query .= $_COOKIE["usuario"];
    }
    
    $Result = mysql_query($query);
    $Registro = mysql_fetch_array($Result);
?>

<h1>Cambiar información privada</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="GET">

    <input type="hidden" name="include" value="usuarios" />
    <input type="hidden" name="action" value="edicion" />
    
    <?php
        if (isset($_REQUEST['codigo'])) {
            print '<input type="hidden" name="codigo" value="'.$_REQUEST['codigo'].'" />';
        }
    ?>
    
    <fieldset>
        
        <label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[1]; ?>">
        
        <label>Apodo:</label>
        <input type="text" id="apodo" name="apodo" size="10" maxlength="10" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[2]; ?>">
        
        <label>Nueva contraseña:</label>
        <input type="password" id="clave" name="clave" size="10" maxlength="10" class="text ui-widget-content ui-corner-all">
        
        <label>Repetir contraseña:</label>
        <input type="password" id="clave_2" name="clave_2" size="10" maxlength="10" class="text ui-widget-content ui-corner-all">
        
        <label>Correo:</label>
        <input type="text" id="correo" name="correo" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[4]; ?>">
    
    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" onclick="return validarCamposFormUsuarios(true)" />

</form>
