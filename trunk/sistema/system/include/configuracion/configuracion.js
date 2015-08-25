
$(function() {
    $('[name="provincia"]').change(function() {
        var provincia = $(this).val();
        iniciarIndicadorCarga($('[name="localidad"]'));
        $('[name="localidad"]').load('include/poblar_combo_localidades.php', { provincia : '' + provincia + '' }, function(data) {
            $(this).html(data);
            $(this).trigger("chosen:updated");
            ocultarIndicadorCarga(this);
        });
    });
});

function validarCamposFormCondiciones() {
    if ($('#codigo').val() == '') {
        actualizarMensajes('Debe ingresar un código!');
        actualizarCampoError($('#codigo'));
        return false;
    }
    if (isNaN($('#codigo').val())) {
        actualizarMensajes('Debe ingresar un código válido!');       
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#codigo').val() < 1) {
        actualizarMensajes('Debe ingresar un código mayor a uno!');     
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#descripcion').val() == '') {
       actualizarMensajes('Debe ingresar una descripción!');
        actualizarCampoError($('#descripcion'));
       return false;
    }
    if ($('#cuotas').val() == '') {
        actualizarMensajes('Debe ingresar una cantidad de cuotas!');         
        actualizarCampoError($('#cuotas'));
        return false;
    }
    if (isNaN($('#cuotas').val())) {
        actualizarMensajes('Debe ingresar una cantidad válida!');                    
        actualizarCampoError($('#cuotas'));
        return false;
    }
    if ($('#cuotas').val() < 0) {
        actualizarMensajes('Debe ingresar una cantidad mayor a cero!');                    
        actualizarCampoError($('#cuotas'));
        return false;
    }
    if ($('#plazo').val() == '') {
        actualizarMensajes('Debe ingresar un plazo!');         
        actualizarCampoError($('#plazo'));
        return false;
    }
    if (isNaN($('#plazo').val())) {
        actualizarMensajes('Debe ingresar un plazo válido!');                    
        actualizarCampoError($('#plazo'));
        return false;
    }
    if ($('#plazo').val() < 0) {
        actualizarMensajes('Debe ingresar un plazo mayor o igual a cero!');                    
        actualizarCampoError($('#plazo'));
        return false;
    }
    if ($('#intervalo').val() == '') {
        actualizarMensajes('Debe ingresar un intervalo!');
        actualizarCampoError($('#intervalo'));
        return false;
    }
    if ($('#intervalo').val() != 'D' && $('#intervalo').val() != 'M' && $('#intervalo').val() != 'A') {
        actualizarMensajes('Debe ingresar un intervalo válido!');              
        actualizarCampoError($('#intervalo'));
        return false;
    }
    if ($('#interes').val() == '') {
        actualizarMensajes('Debe ingresar un interés!');    
        actualizarCampoError($('#interes'));
        return false;
    }
    if (isNaN($('#interes').val())) {
        actualizarMensajes('Debe ingresar un interés válido!');              
        actualizarCampoError($('#interes'));
        return false;
    }
    if ($('#interes').val() < 0) {
        actualizarMensajes('Debe ingresar un interés mayor o igual a cero!');                    
        actualizarCampoError($('#interes'));
        return false;
    }
    return true;
}

function validarCamposFormAlicuotas() {
    if ($('#codigo').val() == '') {
        actualizarMensajes('Debe ingresar un código!');
        actualizarCampoError($('#codigo'));
        return false;
    }
    if (isNaN($('#codigo').val())) {
        actualizarMensajes('Debe ingresar un código válido!');       
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#codigo').val() < 1) {
        actualizarMensajes('Debe ingresar un código mayor a uno!');     
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#descripcion').val() == '') {
       actualizarMensajes('Debe ingresar una descripción!');
        actualizarCampoError($('#descripcion'));
       return false;
    }
    if ($('#alicuota').val() == '') {
        actualizarMensajes('Debe ingresar un porcentaje de alícuota!');    
        actualizarCampoError($('#alicuota'));
        return false;
    }
    if (isNaN($('#alicuota').val())) {
        actualizarMensajes('Debe ingresar un porcentaje válido!');              
        actualizarCampoError($('#alicuota'));
        return false;
    }
    if ($('#alicuota').val() < 0) {
        actualizarMensajes('Debe ingresar un porcentaje mayor o igual a cero!');                    
        actualizarCampoError($('#alicuota'));
        return false;
    }
    return true;
}

function validarCamposFormEmpresa() {
    if ($('#razon').val() == '') {
        actualizarMensajes('Debe ingresar una razón social!');
        actualizarCampoError($('#razon'));
        return false;
    }
    if ($('#localidad').val() == '') {
        actualizarMensajes('Debe seleccionar una localidad!');    
        actualizarCampoError($('#localidad'));
        return false;
    }
    if ($('#domicilio').val() == '') {
        actualizarMensajes('Debe ingresar un domicilio!');
        actualizarCampoError($('#domicilio'));
        return false;
    }
    if ($('#telefono').val() == '') {
        actualizarMensajes('Debe ingresar un teléfono!');         
        actualizarCampoError($('#telefono'));
        return false;
    }
    if ($('#pagina').val() == '') {
        actualizarMensajes('Debe ingresar un página web!');    
        actualizarCampoError($('#pagina'));
        return false;
    }
    if ($('#correo').val() == '') {
        actualizarMensajes('Debe ingresar una dirección de correoe!');              
        actualizarCampoError($('#correo'));
        return false;
    }
    return true;
}