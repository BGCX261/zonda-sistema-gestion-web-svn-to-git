<?php
    include_once('include/listado.php');
    
    $Listado = new Listado();
    
    $Listado->Titulo = 'Listado de tipo de facturas';
    
    $Listado->ConsultaRegistros = 'SELECT * FROM facturas_tipo';
    
    $Listado->Consulta = '
        SELECT
            LPAD(codigo, 11, 0),
            descripcion,
            IF(iva = 1, "Si", "No"),
            IF(discrimina = 1, "Si", "No")
        FROM
            facturas_tipo';
    
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'facturas_tipo.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'facturas_tipo.descripcion',
            'alias' => 'Descripción',
            'alineacion' => 'left',
            'ancho_celda' => '40',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'CONTABILIZA IVA',
            'nombre' => 'facturas_tipo.iva',
            'alias' => 'Contabiliza IVA',
            'alineacion' => 'center',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'DISCRIMINA IVA',
            'nombre' => 'facturas_tipo.discrimina',
            'alias' => 'Discrimina IVA',
            'alineacion' => 'center',
            'ancho_celda' => '20'
        )
    );
    
    $Listado->NombreFiltro = 'filtro_facturas_tipo';
    
    $Listado->NombreTabla = 'tablaFacturasTipo';
    
    $Listado->BotonNuevoRegistro = '<a href="?include=configuracion&form=form_alta_tipo_factura" id="agregar-tipo-factura" class="enlace-agregar">Agregar un nuevo tipo de factura</a><br><br>';
    
    $Listado->Funciones = array(
        array(
            'nombre' => 'Editar',
            'referencia' => '?include=configuracion&form=form_edicion_tipo_factura'
        ),
        array(
            'nombre' => 'Borrar',
            'referencia' => '?include=configuracion&action=baja_tipo_factura',
            'accion' => 'return confirm(\'Desea eliminar este tipo de factura de forma permanente?\')'
        )
    );
    
    $Listado->Mostrar();
?>