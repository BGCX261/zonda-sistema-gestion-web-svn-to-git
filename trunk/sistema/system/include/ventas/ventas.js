
$(function() {
    
    accionCierreBusqueda();
    
    $('#buscar-articulos').click(function(e) {
        e.preventDefault();
        mostrarDialogoBusqueda();
    });
    
    $('#borrar-articulo').click(function(e) {
        e.preventDefault();
        limpiarListaArticulos();
    });
    
});

function cargarDetalleVenta(codigo) { 
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

function cargarDetallePedido(codigo) { 
    $('#dialogo').load('include/ventas/ver_pedido.php', { "pedido": codigo }, function() {
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