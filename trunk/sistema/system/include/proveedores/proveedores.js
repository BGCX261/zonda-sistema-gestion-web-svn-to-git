
var anchoColumnaProveedores = { codigo: 5, razon: 15, nombre: 15, domicilio: 6, telefono: 4, provincia: 6,  
                                localidad: 6, cp: 4, contacto: 15, pagina: 6, correo: 6, saldo: 4, total: 4 };

$(function() {
    iniciarVistaColumnasProveedores();
    redimensionarColumnasProveedores();
    redimensionarDialogoCampos(83);
    
    $('#tabla-datos-show-fields input').click(function() {
        mostrarColumnasTabla('proveedores', this);
        redimensionarColumnasProveedores();
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

function iniciarVistaColumnasProveedores() {
    cargarVista('codigo', eval(localStorage.getItem('proveedores_codigo')));
    cargarVista('razon', eval(localStorage.getItem('proveedores_razon')));
    cargarVista('nombre', eval(localStorage.getItem('proveedores_nombre')));
    cargarVista('domicilio', eval(localStorage.getItem('proveedores_domicilio')));
    cargarVista('telefono', eval(localStorage.getItem('proveedores_telefono')));
    cargarVista('provincia', eval(localStorage.getItem('proveedores_provincia')));
    cargarVista('localidad', eval(localStorage.getItem('proveedores_localidad')));
    cargarVista('cp', eval(localStorage.getItem('proveedores_cp')));
    cargarVista('contacto', eval(localStorage.getItem('proveedores_contacto')));
    cargarVista('pagina', eval(localStorage.getItem('proveedores_pagina')));
    cargarVista('correo', eval(localStorage.getItem('proveedores_correo')));
    cargarVista('saldo', eval(localStorage.getItem('proveedores_saldo')));
    cargarVista('total', eval(localStorage.getItem('proveedores_total')));
}

function redimensionarColumnasProveedores() {
    var ancho = 0;
    $('#tabla-datos-show-fields input:checked').each(
        function() {
            ancho += anchoColumnaProveedores[$(this).attr('name')];
        }
    );
    $('#tabla-datos-show-fields input:checked').each(
        function() {
            var name = $(this).attr('name');
            $('[field=' + name + ']').attr('width', anchoColumnaProveedores[name] / ancho);
        }
    );
}

function mostrarDialogoProveedor(codigo) {
    $('#dialogo').load('include/proveedores/ver_proveedor.php', { codigo: '' + codigo + '' }, function() {
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

function cargarDetalleFactura(codigo) { 
    $('#dialogo').load('include/compras/ver_compra.php', { "venta": codigo }, function() {
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

function validarCamposFormProveedores() {
    if ($('#codigo').val() == '') {
        actualizarMensajes('Debe ingresar un código para este proveedor!');
        actualizarCampoError($('#codigo'));
        return false;
    }
    if (isNaN($('#codigo').val())) {
        actualizarMensajes('Debe ingresar un código de proveedor válido!');       
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#codigo').val() < 1) {
        actualizarMensajes('Debe ingresar un código de proveedor mayor a uno!');     
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#razon').val() == '') {
       actualizarMensajes('Debe ingresar una razón social para este proveedor!');
        actualizarCampoError($('#razon'));
       return false;
    }
    if ($('#localidad').val() == '') {
        actualizarMensajes('Debe seleccionar una categoría para este proveedor!');    
        actualizarCampoError($('#localidad'));
        return false;
    }
    if ($('#domicilio').val() == '') {
        actualizarMensajes('Debe ingresar un domicilio para este proveedor!');
        actualizarCampoError($('#domicilio'));
        return false;
    }
    if ($('#telefono').val() == '') {
        actualizarMensajes('Debe ingresar un teléfono para este proveedor!');         
        actualizarCampoError($('#telefono'));
        return false;
    }
    if ($('#pagina').val() == '') {
        actualizarMensajes('Debe ingresar un página web para este proveedor!');    
        actualizarCampoError($('#pagina'));
        return false;
    }
    if ($('#correo').val() == '') {
        actualizarMensajes('Debe ingresar una dirección de correo para este proveedor!');              
        actualizarCampoError($('#correo'));
        return false;
    }
    if ($('#saldo').val() == '') {
        actualizarMensajes('El saldo del proveedor no puede estar vacío!');    
        actualizarCampoError($('#saldo'));
        return false;
    }
    if (isNaN($('#saldo').val())) {
        actualizarMensajes('Debe ingresar un saldo de proveedor válido!');       
        actualizarCampoError($('#saldo'));
        return false;
    }
    if ($('#saldo').val() < 0) {
        actualizarMensajes('Debe ingresar un saldo de proveedor mayor a cero!');     
        actualizarCampoError($('#saldo'));
        return false;
    }
    return true;
}
