
function validarCamposFormFondos() {
    if ($('#codigo').val() == '') {
        actualizarMensajes('Debe ingresar un código para este fondo!');
        actualizarCampoError($('#codigo'));
        return false;
    }
    if (isNaN($('#codigo').val())) {
        actualizarMensajes('Debe ingresar un código de fondo válido!');       
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#codigo').val() < 1) {
        actualizarMensajes('Debe ingresar un código de fondo mayor a uno!');     
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#descripcion').val() == '') {
        actualizarMensajes('Debe ingresar una descripción para este fondo!');
        actualizarCampoError($('#descripcion'));
        return false;
    }
    if ($('#saldo').val() == '') {
        actualizarMensajes('Debe ingresar un saldo para este fondo!');         
        actualizarCampoError($('#saldo'));
        return false;
    }
    if (isNaN($('#saldo').val())) {
        actualizarMensajes('Debe ingresar un saldo válido!');                    
        actualizarCampoError($('#saldo'));
        return false;
    }
    if (Number($('#saldo').val()) < 0) {
        actualizarMensajes('El saldo no puede ser menor a cero!');    
        actualizarCampoError($('#saldo'));
        return false;
    }
    return true;
}

function validarCamposFormCreditoDebito() {
    if ($('#fondo').val() == '') {
        actualizarMensajes('Debe ingresar un código de fondo!');
        actualizarCampoError($('#fondo'));
        return false;
    }
    if (isNaN($('#fondo').val())) {
        actualizarMensajes('Debe ingresar un código de fondo válido!');       
        actualizarCampoError($('#fondo'));
        return false;
    }
    if ($('#fondo').val() < 1) {
        actualizarMensajes('Debe ingresar un código de fondo mayor a uno!');     
        actualizarCampoError($('#fondo'));
        return false;
    }
    if ($('#monto').val() == '') {
        actualizarMensajes('Debe ingresar un monto para esta operación!');         
        actualizarCampoError($('#monto'));
        return false;
    }
    if (isNaN($('#monto').val())) {
        actualizarMensajes('Debe ingresar un monto válido!');                    
        actualizarCampoError($('#monto'));
        return false;
    }
    if (Number($('#monto').val()) <= 0) {
        actualizarMensajes('El monto no puede ser menor o igual a cero!');    
        actualizarCampoError($('#monto'));
        return false;
    }
    if ($('#concepto').val() == '') {
        actualizarMensajes('Debe ingresar un concepto para esta operación!');
        actualizarCampoError($('#concepto'));
        return false;
    }
    return true;
}