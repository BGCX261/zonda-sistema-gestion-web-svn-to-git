
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

function cargarDetalleCompra(codigo) { 
    $('#dialogo').load('include/compras/detalle.php', { "compra": codigo }, function() {
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