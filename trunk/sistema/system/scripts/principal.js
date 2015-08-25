var paletaColores = [ "#960", "#C90", "#FC0", "#FF0", "#FF9", "#FD9", "#FC6", "#F93", "#F74",
                      "#F30", "#900", "#336", "#039", "#06C", "#08D", "#09F", "#39D", "#9CF",
                      "#BEF", "#DFF", "#FCF", "#CCF", "#99F", "#66C", "#99C", "#669", "#060" ];

$(function() {
    
    iniciarCuadroDialogo();
    iniciarControles();
    iniciarAnimaciones();
    iniciarAnimacionMenu();
    
    var menu_enc_oculto = true;
    
    $('#boton_menu_enc').click(function() {
        menu_enc_oculto = animacionMenu(menu_enc_oculto);
    });
    
    var menu_ver_oculto = true;
    
    $('#boton-ver').click(function() {
        menu_ver_oculto = animacionMenuVerCampos(menu_ver_oculto);
    });
    
    var menu_buscar_oculto = true;
    
    $('#boton-buscar').click(function() {
        menu_buscar_oculto = animacionMenuBuscar(menu_buscar_oculto);
    });
    
    var menu_calcular_oculto = true;
    
    $('#boton-calcular').click(function() {
        menu_calcular_oculto = animacionMenuCalcular(menu_calcular_oculto);
    });
    
    $('.acciones-tabla').click(function() {
        animacionAccionesTabla(this);
    });
    
    $('.tabla-datos td[field]').click(function() {
        var tabla = $(this).parent().parent().parent().attr('name');
        accionFilaTabla(tabla, this);
    });
    
    $('.accion-tabla-borrar').click(function(event) {
        event.preventDefault();
        confirmarBorrado(this, "Desea eliminar este registro?");
    });
    
    centrarDialogoBusqueda();
    
    cargarFuncionesDialogoBusqueda();
    
    $('.buscar-item').click(function() {
        mostrarDialogoBusqueda();
    });
    
    $('select').chosen();
    
    
    
    
    
    
    
    
    
    
    
    
    
});



function iniciarCuadroDialogo() {
    $('#dialogo').dialog({
        resizable: true,
        height: 150,
        width: 400,
        modal: true,
        autoOpen: false,
        buttons: {
            "Aceptar": function() {
                $(this).dialog("close");
            }
        }
    });
}

function iniciarControles() {
    $(".enlace-agregar").button();
    $(".boton-informe").button();
    $(".fecha").datepicker({ dateFormat: "dd/mm/yy" });
    $('#menu_enc ul').append('<li id="boton_menu_enc"><a></a></li>');
}

function iniciarAnimaciones() {
    animacionLogoEncabezado();
    animacionBotonesAccionTabla();
    $('#encabezado').animate({ left: '-170px' });
    $('#menu_options').animate({ left: '-390px' });
    $('#menu_options img').css({ 'float': 'right' });
    $('#cuerpo').animate({ 'margin-left': '10px' });
    $('#tabla-datos-show-fields').animate({ 'margin-top': '-65px' });
    $('#tabla-datos-search-form').animate({ 'margin-top': '-140px' });
    $('#tabla-datos-calculate').animate({ 'margin-top': '-90px' });
    $('.acciones-tabla').css({ width : '0px' });
    $('.acciones-tabla .boton-acciones').hide();
    $('.estado-consulta').fadeOut(1);
    $('.contenedor-tabla').fadeOut(1);
    $('#mascara-carga-datos').fadeOut(1);
    $('#carga-datos').fadeOut(1);
}

function iniciarAnimacionMenu() {
    $('.menu_enc_li').hover(
        function() {
            var menu = $(this).attr('id');
            $('#sub' + menu).siblings('ul').not('#sub' + menu).css({ display: "none" });
            $('#sub' + menu).fadeIn();
        },
        function() {
            /* NADA */
        }
    );
    var menu = $.urlParam('include');
    if (menu) {
        $('#submenu_' + menu).css({ display: 'block' });
    }
    else {
        $('#submenu_inicio').css({ display: 'block' });
    }
}

function cargarVista(campo, ver) {
    $("#tabla-datos-show-fields input[name=" + campo + "]").prop("checked", ver);
    if (!ver) {
        $('[field=' + campo + ']').hide();
    }
}

function animacionMenu(menu_enc_oculto) {
    if (menu_enc_oculto) {
        $('#encabezado').animate({ left: '0px' });
        $('#menu_options').animate({ left: '0px' });
        $('#menu_options img').css({ 'float': 'left' });
        $('#cuerpo').animate({ 'margin-left': '400px' });
        return false;
    }
    else {
        $('#encabezado').animate({ left: '-170px' });
        $('#menu_options').animate({ left: '-390px' }, function() {
            $('#menu_options img').css({ 'float': 'right' });
        });
        $('#cuerpo').animate({ 'margin-left': '10px' });
        return true;
    }
}

function animacionMenuVerCampos(menu_ver_oculto) {   
    var top = -($('#tabla-datos-show-fields').height() + 5);
    var margin = top + 'px';
    if (menu_ver_oculto) {
        $('#tabla-datos-show-fields').animate({ 'margin-top': '-5px' });
        return false;
    }
    else {
        $('#tabla-datos-show-fields').animate({ 'margin-top': '' + margin + '' });
        return true;
    }
}

function animacionMenuBuscar(menu_buscar_oculto) {
    if (menu_buscar_oculto) {
        $('#tabla-datos-search-form').animate({ 'margin-top': '-5px' });
        return false;
    }
    else {
        $('#tabla-datos-search-form').animate({ 'margin-top': '-140px' });
        return true;
    }
}

function animacionMenuCalcular(menu_calcular_oculto) {
    if (menu_calcular_oculto) {
        $('#tabla-datos-calculate').animate({ 'margin-top': '-5px' });
        return false;
    }
    else {
        $('#tabla-datos-calculate').animate({ 'margin-top': '-90px' });
        return true;
    }
}

function mostrarColumnasTabla(tabla, checkbox) {
    var name = $(checkbox).attr('name');
    if($(checkbox).is(':checked')) {
        $('[field=' + name + ']').show();
        localStorage.setItem(tabla + '_' + name, true);
    }
    else {
        $('[field=' + name + ']').hide();
        localStorage.setItem(tabla + '_' + name, false);
    }
}

function animacionAccionesTabla(control) {
    if($(control).width() < 50) {
        $('.acciones-tabla .boton-acciones').hide();
        $('.acciones-tabla').animate({ width : '0px' }, 'fast');
        $(control).animate({ width: '68px' });
        $(control).children('.boton-acciones').show();
    }
    else {
        $(control).children('.boton-acciones').hide();
        $(control).animate({ width: '0px' });
    }
}

function animacionLogoEncabezado() {
    var logo_anim = false;
    $('#logo').hover(
        function() {
            if (!logo_anim) {
                $(this).effect('shake', { distance: 3 } );
                logo_anim = true;
            }
        },
        function() {
            logo_anim = false;
        }
    );
}

function animacionBotonesAccionTabla() {
    $('.boton-acciones').fadeTo(1, 0.2);
    $('.boton-acciones').hover(
        function() {
            $(this).fadeTo('fast', 1.0);
        },
        function() {
            $(this).fadeTo('fast', 0.2);
        }
    );
}

function accionFilaTabla(tabla, control) {
    var codigo = Number($(control).parent().children('[field="codigo"]').text());
    switch(tabla) {
        case 'tabla-articulos':
        case 'tabla-lista-de-precios':
            mostrarDialogoArticulo(codigo);
            break;
        case 'tabla-categorias':
            mostrarDialogoCategoria(codigo);
            break;
        case 'tabla-marcas':
            mostrarDialogoMarca(codigo);
            break;
        case 'tabla-listas-precios':
            cargarListaPrecios(codigo);
            break;
        case 'tabla-articulos-sin-lista':
            var estado = $(control).parent().children('.celda-estado-consulta').children('.estado-consulta');
            var input = $(control).parent().children().children('[name="precio"]');
            var lista = $(input).attr('lista');
            var codigo = $(input).attr('codigo');
            var precio = $(input).val();
            agregarArticuloListaPrecios(estado, lista, codigo, precio);
            break;
        case 'tabla-clientes':
            mostrarDialogoCliente(codigo);
            break;
        case 'tabla-pendientes':
            mostrarDialogoPendiente(codigo);
            break;
        case 'tabla-compras':
            cargarDetalleCompra(codigo);
            break;
        case 'tabla-ventas':
            cargarDetalleVenta(codigo);
            break;
        case 'tabla-pedidos':
            cargarDetallePedido(codigo);
            break;
        case 'tabla-facturas':
            cargarDetalleFactura(codigo);
            break;
        case 'tabla-proveedores':
            mostrarDialogoProveedor(codigo);
            break;
    }
}

function confirmarBorrado(control, message) {
    $('#dialogo').dialog({ width: 300, height: 160,
         buttons: {
            "Borrar registro": function() {
                $(this).dialog("close");
                window.location.href = $(control).attr('href');
            },
            "Cancelar": function() {
                $(this).dialog("close");
            }
        }
    });
    $('#dialogo').html('<p class="mensaje-accion">' + message + '</p>');
    $('#dialogo').dialog('open');
}

function traerControlEstado(control) {
    return $(control).parent().parent().children('.celda-estado-consulta').children('.estado-consulta');
}

function centrarDialogoBusqueda() {
    var prin_h = $('#principal').css('height');
    var prin_w = $('#principal').css('width');
    prin_w = prin_w.substr(0, prin_w.length - 2);
    var carga_w = $('#carga-datos').css('width');
    carga_w = carga_w.substr(0, carga_w.length - 2);
    var left = (prin_w - carga_w) / 2 + 'px';
    $('#mascara-carga-datos').css({ height : '' + prin_h + '' });
    $('#carga-datos').css({ left : '' + left + '' });
}

function cargarFuncionesDialogoBusqueda() {
    $('input[name="campo-busqueda"]').change(function() {
        if($(this).val() !== '') {
            cargarTablaBusqueda($(this).val());
        }
    });
    $('input[name="campo-busqueda"]').click(function() {
        $(this).select();
    });
    $('#mascara-carga-datos').click(function() {
        ocultarDialogoBusqueda();
    });
}

function mostrarDialogoBusqueda() {
    $('[name="campo-busqueda"]').val('');
    $('#tabla-busqueda').empty();
    $('#mascara-carga-datos').fadeIn('fast');
    $('#carga-datos').fadeIn('fast');
    $('[name="campo-busqueda"]').focus();
    $(document).keydown(function(event) {
        if (event.which === 27) {
            ocultarDialogoBusqueda();
        }
    });
}

function ocultarDialogoBusqueda() {
    $('#carga-datos').fadeOut('fast');
    $('#mascara-carga-datos').fadeOut('fast');
    $(document).unbind('keydown');
    accionCierreBusqueda();
}

function iniciarEstadoCarga(control) {
    limpiarEstadoConsulta(control);
    control.addClass('estado-indicador-carga');
}

function ocultarEstadoConsulta(control) {
    control.fadeOut('fast');
}

function mostrarEstadoHecho(control) {
    control.removeClass('estado-indicador-carga'); 
    control.addClass('estado-indicador-hecho');
    control.fadeIn('fast');
}

function mostrarEstadoError(control) {
    control.removeClass('estado-indicador-carga'); 
    control.addClass('estado-indicador-error');
    control.fadeIn('fast');
}

function limpiarEstadoConsulta(control) {
    control.removeClass('estado-indicador-carga'); 
    control.removeClass('estado-indicador-hecho'); 
    control.removeClass('estado-indicador-error');
}

function mostrarIndicadorAgregar(fila) {
    $(fila).children('.celda-agregar-item').children('.indicador-accion').addClass('estado-indicador-agregar');
    $(fila).children('.celda-agregar-item').children('.indicador-accion').fadeIn('fast');
}

function ocultarIndicadorAgregar(fila) {
    $(fila).children('.celda-agregar-item').children('.indicador-accion').removeClass('estado-indicador-agregar');
    $(fila).children('.celda-agregar-item').children('.indicador-accion').fadeOut('fast');
}

function iniciarIndicadorCarga(control) {
    $(control).css( { 'background-image' : 'url(images/cargando.gif)', 'background-repeat' : 'no-repeat' } );
}

function ocultarIndicadorCarga(control) {
    $(control).css( { 'background-image' : 'none' } );
}

function redimensionarDialogoCampos(h) {
    $('#tabla-datos-show-fields').height(h);
    var margin = '-' + (h + 5) + 'px';
    $('#tabla-datos-show-fields').animate({ 'margin-top': '' + margin + '' });
}








$.urlParam = function(name){
    var url = window.location.href.split('?');
    if (url.length < 2) {
        return '';
    }
    var uri = url[1];
    var vars = uri.split('&'); 
    for(var i = 0; i < vars.length; i++) { 
        var par = vars[i].split('='); 
        if(par[0] === name) {
            return par[1];
        }
    }
}











/*
 * FUNCIONES PARA TRABAJAR CON COOKIES:
 */
function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}








/*
 * MUESTRA UN MENSAJE DE ERROR EN LOS FORMULARIOS:
 */
function actualizarMensajes(t) {
    $('#mensaje-error')
    .text(t)
    .addClass("ui-state-highlight ui-corner-all");
    setTimeout(
        function() {
            $('#mensaje-error').removeClass("ui-state-highlight ui-corner-all", 1500);
        },
        500
    );
}

/*
 * MARCA EL CAMPO DEL FORMULARIO QUE CONTIENE UN ERROR:
 */
function actualizarCampoError(c) {
    c.addClass("ui-state-error");
    c.change(
        function() {
            c.removeClass("ui-state-error");
        }
    );
}

/*
 * VERIFICAR LOS CAMPOS DEL FORMULARIO DE REGISTRO:
 */
function verificarCamposRegistro() {
    $('.text').removeClass("ui-state-highlight");
    if ($('#nombre').val() == '') {
        $('#nombre').addClass("ui-state-highlight");
        actualizarMensajes("Debe ingresar su nombre para continuar!");
        return false;
    }
    if ($('#correo').val() == '') {
        $('#correo').addClass("ui-state-highlight");
        actualizarMensajes("Debe ingresar una dirección de correo válida!");
        return false;
    }
    if (!verificarCorreo($('#correo').val())) {
        return false;
    }
    return true;
}

/*
 * VERFICAR SI LA DIRECCION DE CORREO ES VALIDA:
 */
function verificarCorreo(correo) {
    if (correo == '') {
      return false;
   }
   var checkTLD = 1;
   var knownDomsPat = /^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
   var emailPat = /^(.+)@(.+)$/;
   var specialChars = "\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
   var validChars = "\[^\\s" + specialChars + "\]";
   var quotedUser = "(\"[^\"]*\")";
   var ipDomainPat = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
   var atom = validChars + '+';
   var word = "(" + atom + "|" + quotedUser + ")";
   var userPat = new RegExp("^" + word + "(\\." + word + ")*$");
   var domainPat = new RegExp("^" + atom + "(\\." + atom +")*$");
   var matchArray = correo.match(emailPat);
   if (matchArray == null) {
      return false;
   }
   var user = matchArray[1];
   var domain = matchArray[2];
   for (i = 0; i < user.length; i++) {
      if (user.charCodeAt(i) > 127) {
         return false;
      }
   }
   for (i = 0; i < domain.length; i++) {
      if (domain.charCodeAt(i) > 127) {
         return false;
      }
   }
   if (user.match(userPat) == null) {
      return false;
   }
   var IPArray = domain.match(ipDomainPat);
   if (IPArray != null) {
      for (var i = 1; i <= 4; i++) {
         if (IPArray[i] > 255) {
            return false;
         }
      }
      return true;
   }
   var atomPat = new RegExp("^" + atom + "$");
   var domArr = domain.split(".");
   var len = domArr.length;
   for (i = 0; i < len; i++) {
      if (domArr[i].search(atomPat) == -1) {
         return false;
      }
   }
   if (checkTLD && domArr[domArr.length-1].length != 2 && domArr[domArr.length-1].search(knownDomsPat) == -1) {
      return false;
   }
   if (len < 2) {
      return false;
   }
   return true;
}