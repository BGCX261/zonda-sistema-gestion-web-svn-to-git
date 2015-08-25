
var anchoColumnaArticulos = { codigo: 5, descripcion: 25, categoria: 15, proveedor: 15,  
                              marca: 15, costo: 5, precio: 5, alicuota: 5, existencia: 5 };

$(function() {
    iniciarVistaColumnasArticulos();
    redimensionarColumnasArticulos();
    
    $('#tabla-datos-show-fields input').click(function() {
        mostrarColumnasTabla('articulos', this);
        redimensionarColumnasArticulos();
    });
    
    $('.precio-lista').change(function() {
        var estado = traerControlEstado(this);
        var codigo = $(this).attr('codigo');
        var precio = $(this).val();
        modificarPrecioLista(estado, codigo, precio);
    });
    
    $('.costo-lista').change(function() {
        var estado = traerControlEstado(this);
        var codigo = $(this).attr('codigo');
        var costo = $(this).val();
        modificarCostoArticulo(estado, codigo, costo);
    });
    
    $('table[name="tabla-articulos-sin-lista"] tr').hover(
        function() {
            mostrarIndicadorAgregar(this);
        },
        function() { 
            ocultarIndicadorAgregar(this);
        }
    );
    
    accionCierreBusqueda();
    
    $('#buscar-articulos').click(function(e) {
        e.preventDefault();
        mostrarDialogoBusqueda();alert();
    });
    
    $('#borrar-articulo').click(function(e) {
        e.preventDefault();
        limpiarListaArticulos();
    });
});

function iniciarVistaColumnasArticulos() {
    cargarVista('codigo', eval(localStorage.getItem('articulos_codigo')));
    cargarVista('descripcion', eval(localStorage.getItem('articulos_descripcion')));
    cargarVista('categoria', eval(localStorage.getItem('articulos_categoria')));
    cargarVista('proveedor', eval(localStorage.getItem('articulos_proveedor')));
    cargarVista('marca', eval(localStorage.getItem('articulos_marca')));
    cargarVista('costo', eval(localStorage.getItem('articulos_costo')));
    cargarVista('precio', eval(localStorage.getItem('articulos_precio')));
    cargarVista('alicuota', eval(localStorage.getItem('articulos_alicuota')));
    cargarVista('existencia', eval(localStorage.getItem('articulos_existencia')));
}

function redimensionarColumnasArticulos() {
    var ancho = 0;
    $('#tabla-datos-show-fields input:checked').each(
        function() {
            ancho += anchoColumnaArticulos[$(this).attr('name')];
        }
    );
    $('#tabla-datos-show-fields input:checked').each(
        function() {
            var name = $(this).attr('name');
            $('[field=' + name + ']').attr('width', anchoColumnaArticulos[name] / ancho);
        }
    );
}
 
function agregarArticuloListaPrecios(estado, lista, codigo, precio) {
    iniciarEstadoCarga(estado);
    $.post('include/articulos/alta_articulo_lista.php', { 'lista': lista, 'codigo': codigo, 'precio': precio }, function(data) {
        ocultarEstadoConsulta(estado);
        if(data === '0') {
            mostrarEstadoHecho(estado);
            setTimeout(function() { 
                estado.parent().parent().fadeOut('fast'); 
                limpiarEstadoConsulta(estado);
            }, 500);
        }
        else {
            mostrarEstadoError(estado);
        }
    });
}

function mostrarDialogoArticulo(codigo) {
    $('#dialogo').load('include/articulos/ver_articulo.php', { 'codigo': codigo }, function() {
        $('#dialogo').dialog({ width: 920, height: 490 , 
            buttons: {
                "Aceptar": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('#dialogo').dialog('open');
    });
}

function mostrarDialogoCategoria(codigo) {
    $('#dialogo').load('include/articulos/ver_categoria.php', { 'codigo': codigo }, function() {
        $('#dialogo').dialog({ width: 660, height: 365, 
            buttons: {
                "Aceptar": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('#dialogo').dialog('open');
    });
}

function mostrarDialogoMarca(codigo) {
    $('#dialogo').load('include/articulos/ver_marca.php', { 'codigo': codigo }, function() {
        $('#dialogo').dialog({ width: 660, height: 365, 
            buttons: {
                "Aceptar": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('#dialogo').dialog('open');
    });
}

function cargarListaPrecios(codigo) {
    window.location.href = '?include=articulos&form=listado_lista_de_precios&inicio=0&cantidad=25&lista=' + Number(codigo);
}

function modificarPrecioLista(estado, codigo, precio) {
    iniciarEstadoCarga(estado);
    $.post('include/articulos/guardar_precio.php', { 'codigo': codigo, 'precio': precio }, function(data) {
        ocultarEstadoConsulta(estado);
        if(data === '0') {
            mostrarEstadoHecho(estado);
            setTimeout(function() { 
                estado.fadeOut('fast'); 
                limpiarEstadoConsulta(estado);
            }, 1000);
        }
        else {
            mostrarEstadoError(estado);
        }
    });
}

function modificarCostoArticulo(estado, codigo, costo) {
    iniciarEstadoCarga(estado);
    $.post('include/articulos/guardar_costo.php', { 'codigo': codigo, 'costo': costo }, function(data) {
        ocultarEstadoConsulta(estado);
        if(data === '0') {
            mostrarEstadoHecho(estado);
            setTimeout(function() { 
                estado.fadeOut('fast'); 
                limpiarEstadoConsulta(estado);
            }, 1000);
        }
        else {
            mostrarEstadoError(estado);
        }
    });
}

function validarCamposFormArticulos() {
    if ($('#codigo').val() == '') {
        actualizarMensajes('Debe ingresar un código para este artículo!');
        actualizarCampoError($('#codigo'));
        return false;
    }
    if (isNaN($('#codigo').val())) {
        actualizarMensajes('Debe ingresar un código de artículo válido!');       
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#codigo').val() < 1) {
        actualizarMensajes('Debe ingresar un código de artículo mayor a uno!');     
        actualizarCampoError($('#codigo'));
        return false;
    }
    if ($('#descripcion').val() == '') {
       actualizarMensajes('Debe ingresar una descripción para este artículo!');
        actualizarCampoError($('#descripcion'));
       return false;
    }
    if ($('#categoria').val() == null) {
        actualizarMensajes('Debe seleccionar una categoría para este artículo!');    
        actualizarCampoError($('#categoria'));
        return false;
    }
    if ($('#proveedor').val() == null) {
        actualizarMensajes('Debe seleccionar un proveedor para este artículo!');
        actualizarCampoError($('#proveedor'));
        return false;
    }
    if ($('#costo').val() == '') {
        actualizarMensajes('Debe ingresar un costo para este artículo!');         
        actualizarCampoError($('#costo'));
        return false;
    }
    if (isNaN($('#costo').val())) {
        actualizarMensajes('Debe ingresar un costo válido!');                    
        actualizarCampoError($('#costo'));
        return false;
    }
    if ($('#costo').val() < 0) {
        actualizarMensajes('Debe ingresar un costo mayor a cero!');     
        actualizarCampoError($('#costo'));
        return false;
    }
    if ($('#precio').val() == '') {
        actualizarMensajes('Debe ingresar un precio para este artículo!');         
        actualizarCampoError($('#precio'));
        return false;
    }
    if (isNaN($('#precio').val())) {
        actualizarMensajes('Debe ingresar un precio válido!');                    
        actualizarCampoError($('#precio'));
        return false;
    }
    if ($('#precio').val() < 0) {
        actualizarMensajes('Debe ingresar un precio mayor a cero!');     
        actualizarCampoError($('#precio'));
        return false;
    }
    if ($('#alicuota').val() == null) {
        actualizarMensajes('Debe seleccionar una alícuota para este artículo!');
        actualizarCampoError($('#alicuota'));
        return false;
    }
    return true;
}

function cargarDetalleAjuste(codigo) { 
    $('#dialogo').load('include/articulos/detalle.php', { "compra": codigo }, function() {
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
