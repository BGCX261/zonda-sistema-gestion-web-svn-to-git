
var anchoColumnaClientes = { codigo: 5, razon: 15, nombre: 15, domicilio: 6, telefono: 4, provincia: 6,  
                             localidad: 6, cp: 4, contacto: 15, pagina: 6, correo: 6, saldo: 4, total: 4 };

$(function() {
    iniciarVistaColumnasClientes();
    redimensionarColumnasClientes();
    redimensionarDialogoCampos(83);
    
    $('#tabla-datos-show-fields input').click(function() {
        mostrarColumnasTabla('clientes', this);
        redimensionarColumnasClientes();
    });
    
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

function iniciarVistaColumnasClientes() {
    cargarVista('codigo', eval(localStorage.getItem('clientes_codigo')));
    cargarVista('razon', eval(localStorage.getItem('clientes_razon')));
    cargarVista('nombre', eval(localStorage.getItem('clientes_nombre')));
    cargarVista('domicilio', eval(localStorage.getItem('clientes_domicilio')));
    cargarVista('telefono', eval(localStorage.getItem('clientes_telefono')));
    cargarVista('provincia', eval(localStorage.getItem('clientes_provincia')));
    cargarVista('localidad', eval(localStorage.getItem('clientes_localidad')));
    cargarVista('cp', eval(localStorage.getItem('clientes_cp')));
    cargarVista('contacto', eval(localStorage.getItem('clientes_contacto')));
    cargarVista('pagina', eval(localStorage.getItem('clientes_pagina')));
    cargarVista('correo', eval(localStorage.getItem('clientes_correo')));
    cargarVista('saldo', eval(localStorage.getItem('clientes_saldo')));
    cargarVista('total', eval(localStorage.getItem('clientes_total')));
}

function redimensionarColumnasClientes() {
    var ancho = 0;
    $('#tabla-datos-show-fields input:checked').each(
        function() {
            ancho += anchoColumnaClientes[$(this).attr('name')];
        }
    );
    $('#tabla-datos-show-fields input:checked').each(
        function() {
            var name = $(this).attr('name');
            $('[field=' + name + ']').attr('width', anchoColumnaClientes[name] / ancho);
        }
    );
}

function mostrarDialogoCliente(codigo) {
    $('#dialogo').load('include/clientes/ver_cliente.php', { codigo: '' + codigo + '' }, function() {
        $('#dialogo').dialog({ width: 920, height: 430 , 
            buttons: {
                "Aceptar": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('#dialogo').dialog('open');
    });
}

function mostrarDialogoPendiente(codigo) {
    $('#dialogo').load('include/clientes/ver_pendiente.php', { codigo: '' + codigo + '' }, function() {
        $('#dialogo').dialog({ width: 790, height: 360, 
            buttons: {
                "Aceptar": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('#dialogo').dialog('open');
    });
}

function cargarDetalleFactura(codigo) { 
    $('#dialogo').load('include/ventas/ver_venta.php', { "venta": codigo }, function() {
        $('#dialogo').dialog({ width: 660, height: 420, 
            buttons: {
                "Aceptar": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('#dialogo').dialog('open');
    });
}

function validarCamposFormClientes() {
    if ($('#codigo').val() == '') {
        actualizarMensajes('Debe ingresar un código para este cliente!');
        actualizarCampoError($('#codigo'));
        return false;
    }
    if (isNaN($('#codigo').val())) {
        actualizarMensajes('Debe ingresar un código de cliente válido!');       
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#codigo').val() < 1) {
        actualizarMensajes('Debe ingresar un código de cliente mayor a uno!');     
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#razon').val() == '') {
       actualizarMensajes('Debe ingresar una razón social para este cliente!');
        actualizarCampoError($('#razon'));
       return false;
    }
    if ($('#localidad').val() == '') {
        actualizarMensajes('Debe seleccionar una localidad para este cliente!');    
        actualizarCampoError($('#localidad'));
        return false;
    }
    if ($('#domicilio').val() == '') {
        actualizarMensajes('Debe ingresar un domicilio para este cliente!');
        actualizarCampoError($('#domicilio'));
        return false;
    }
    if ($('#telefono').val() == '') {
        actualizarMensajes('Debe ingresar un teléfono para este cliente!');         
        actualizarCampoError($('#telefono'));
        return false;
    }
    if ($('#pagina').val() == '') {
        actualizarMensajes('Debe ingresar un página web para este cliente!');    
        actualizarCampoError($('#pagina'));
        return false;
    }
    if ($('#correo').val() == '') {
        actualizarMensajes('Debe ingresar una dirección de correo para este cliente!');              
        actualizarCampoError($('#correo'));
        return false;
    }
    if ($('#saldo').val() == '') {
        actualizarMensajes('El saldo del cliente no puede estar vacío!');    
        actualizarCampoError($('#saldo'));
        return false;
    }
    if (isNaN($('#saldo').val())) {
        actualizarMensajes('Debe ingresar un saldo de cliente válido!');       
        actualizarCampoError($('#saldo'));
        return false;
    }
    if ($('#saldo').val() < 0) {
        actualizarMensajes('Debe ingresar un saldo de cliente mayor a cero!');     
        actualizarCampoError($('#saldo'));
        return false;
    }
    return true;
}
