<?php

    include_once("include/util.php");
    
    $query = "SELECT root FROM usuarios WHERE codigo = '".$_COOKIE["usuario"]."'";
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    $Root = mysql_fetch_array($Result);
    
    if ($Root[0] < 1) {
        error_msg("No tiene permisos de administrador para realizar esta acción!");
        return;
    }
    
?>

<h1>Registrar usuario</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="GET">

    <input type="hidden" name="include" value="usuarios" />
    <input type="hidden" name="action" value="alta" />

    <fieldset>

        <label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" />

        <label>Apodo:</label>
        <input type="text" id="apodo" name="apodo" size="10" maxlength="10" class="text ui-widget-content ui-corner-all" />

        <label>Contraseña:</label>
        <input type="password" id="clave" name="clave" size="10" maxlength="10" class="text ui-widget-content ui-corner-all" />

        <label>Repetir contraseña:</label>
        <input type="password" id="clave_2" name="clave_2" size="10" maxlength="10" class="text ui-widget-content ui-corner-all" />

        <label>Correo:</label>
        <input type="text" id="correo" name="correo" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" />

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" onclick="return validarCamposFormUsuarios(false)" />

</form>