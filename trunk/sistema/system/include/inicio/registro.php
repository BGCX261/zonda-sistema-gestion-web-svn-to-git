<h1>
    Registre su sistema!
</h1>

<p>
    Registrando su sistema acceder&aacute; inmediatamente al soporte t&eacute;cnico oficial y a las actualizaciones peri&oacute;dicas 
    para mantener al m&aacute;ximo el rendimiento de Gesti&oacute;n Web.
    <br>
    <br>
    Tenga en cuenta que debe ingresar un correo v&aacute;lido para poder recibir las noticias y las actualizaciones necesarias.
    <br>
    <br>
    Las actualizaciones proporcionan mejoras en la funcionalidad y corrigen errores en el sistema.
    <br>
    <br>
</p>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" method="GET">
    
    <input type="hidden" name="include" value="inicio" />
    <input type="hidden" name="action" value="registrado" />

    <fieldset>

        <label>Nombre:</label>
        <input type="text" name="nombre" id="nombre" class='text ui-widget-content ui-corner-all' />

        <label>Compa&ntilde;&iacute;a:</label>
        <input type="text" name="compania" id="compania" class='text ui-widget-content ui-corner-all' />

        <label>Rubro:</label>
        <input type="text" name="rubro" id="rubro" class='text ui-widget-content ui-corner-all' />

        <label>Correo electr&oacute;nico:</label>
        <input type="text" name="correo" id="correo" class='text ui-widget-content ui-corner-all' />

        <label>Tel&eacute;fono:</label>
        <input type="text" name="telefono" id="telefono" class='text ui-widget-content ui-corner-all' />

    </fieldset>

    <input type="submit" value="Registrarse!" onclick="return verificarCamposRegistro()" />

</form>
