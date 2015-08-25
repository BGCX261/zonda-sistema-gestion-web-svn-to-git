
function validarCamposFormUsuarios(esEdicion) {
    if ($('#nombre').val() == '') {
        actualizarMensajes('Debe ingresar su nombre para poder registrarse!');
        actualizarCampoError($('#nombre'));
        return false;
    }
    if ($('#apodo').val() == '') {
        actualizarMensajes('Debe ingresar un apodo para poder registrarse!');
        actualizarCampoError($('#apodo'));
        return false;
    }
    if ($('#clave').val() == '') {
        if (!esEdicion) {
            actualizarMensajes('La clave no puede estar vacía!');
            actualizarCampoError($('#clave'));
            return false;
        }
    }
    else {
        if ($('#clave').val() != $('#clave_2').val()) {
            actualizarMensajes('Verifique su clave, los campos no coinciden!');      
            actualizarCampoError($('#clave'));     
            actualizarCampoError($('#clave_2'));
            return false;
        }
    }
    if ($('#correo').val() == '') {
        actualizarMensajes('Debe ingresar un correo para poder registrarse!');
        actualizarCampoError($('#correo'));
        return false;
    }
    return true;
}
