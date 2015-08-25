
function accionFilaTablaBusqueda(fila) {
    var cod = $(fila).children('td[name="codigo"]').text();
    $.post('include/agregar_articulo_lista.php', { "codigo": cod });
    $(fila).fadeOut('fast');
}

function cargarTablaBusqueda(busqueda) {
    $('#tabla-busqueda').load('include/cargar_tabla_busqueda_articulos.php', { "busqueda": busqueda }, 
        function(data) {
            $('#tabla-busqueda').html(data);
            $('.contenedor-tabla').fadeIn('fast');
            $('#tabla-busqueda tr').click(function() {
                accionFilaTablaBusqueda(this);
            });
        }
    );
}

function accionCierreBusqueda() {
    cargarTablaListaArticulos();
}

function cargarTablaListaArticulos() {
    $.post('include/listado_articulos_factura.php', function(data) {
        $('#panel-lista-articulos-factura').html(data);
        accionCambiarCantidadArticulo();
        accionBorrarArticulo();
        cargarTotalesListaArticulos();
    });
}

function cargarTotalesListaArticulos() {
    $.post('include/tabla_totales_factura.php', function(data) {
        $('#panel-total-articulos-factura').html(data);
    });
}

function accionCambiarCantidadArticulo() {
    $('.cantidad-articulo').change(function() {
        var estado = traerControlEstado(this);
        var codigo = $(this).attr('codigo');
        var cantidad = $(this).val();
        modificarCantidadListaArticulos(estado, codigo, cantidad);
    });
}

function modificarCantidadListaArticulos(estado, codigo, cantidad) {
    $.post('include/cambiar_cantidad_factura.php', { "codigo": codigo, "cantidad": cantidad }, function(data) {
        if(data === '0') {
            cargarTablaListaArticulos();
        }
        else {
            mostrarEstadoError(estado);
            setTimeout(function() { 
                estado.fadeOut('fast'); 
                limpiarEstadoConsulta(estado);
            }, 1000);
        }
    });
}

function accionBorrarArticulo() {
    $('.accion-tabla-borrar').click(function() {
        var fila = $(this).parent().parent();
        var estado = traerControlEstado(this);
        var codigo = $(this).attr('codigo');
        borrarItemListaArticulos(fila, estado, codigo);
    });
}

function borrarItemListaArticulos(fila, estado, codigo) {
    iniciarEstadoCarga(estado);
    $.post('include/borrar_articulo_factura.php', { "codigo": codigo }, function(data) {
        ocultarEstadoConsulta(estado);
        if(data === '0') {
            mostrarEstadoHecho(estado);
            setTimeout(function() { 
                estado.fadeOut('fast'); 
                limpiarEstadoConsulta(estado);
                cargarTotalesListaArticulos();
                $(fila).fadeOut('fast');
            }, 1000);
        }
        else {
            mostrarEstadoError(estado);
        }
    });
}

function limpiarListaArticulos() {
    $.post('include/borrar_lista_factura.php', function() {
        cargarTotalesListaArticulos();
    });
    $('#lista-articulos-factura tbody').fadeOut('fast');
}
