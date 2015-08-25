<?php
    include ('conexion.php');
    include ('util.php');
    
    print '<h1>Listado de proveedores acreedores</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        print '<p class="parametros-informe" align="right">
                <button id="exportar_informe">Exportar</button>
                <button id="imprimir_informe">Imprimir</button>
            </p>';
    
    }
    
    $query = "
        SELECT
            proveedores.codigo
        FROM
            proveedores   
        WHERE
            saldo > 0";
    
    $Result = mysql_query($query);
    $Registros = mysql_num_rows($Result);
    
    if (!isset($_REQUEST['impresion'])) {
    
        print '<input type="hidden" id="inicio" value="'.$_REQUEST['inicio'].'" />';
        print '<input type="hidden" id="cantidad" value="'.$_REQUEST['cantidad'].'" />';
        print '<input type="hidden" id="registros" value="'.$Registros.'" />';
        
    }
    
    $Plural = '';
    if ($Registros > 1)
        $Plural = 's';
    $Cantidad = $Registros;
    if ($Registros < 1)
        $Cantidad = 'Ningún';
    print '<p><label class="info_tabla">'.$Cantidad.' registro'.$Plural.' encontrado'.$Plural.'</label><br></p>';
    
    $query = "
        SELECT
            LPAD(proveedores.codigo, 12, 0),
            proveedores.razon,
            proveedores.domicilio,
            proveedores.telefono,
            localidades.localidad,
            proveedores.pagina,  
            proveedores.correo,
            CONCAT('$', proveedores.saldo)
        FROM
            proveedores, 
            localidades    
        WHERE
            proveedores.localidad = localidades.codigo
            AND
            saldo > 0 
        ORDER BY
            proveedores.codigo
        LIMIT
            ".$_REQUEST['inicio'].", ".$_REQUEST['cantidad'];
    
    $NombreCampos = array('Código', 'Razón social', 'Domicilio', 'Teléfono', 'Localidad', 'Página web', 'Correo electrónico', 'Saldo de la cuenta');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('10%', '20%', '10%', '10%', '15%', '10%', '15%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
    if (!isset($_REQUEST['impresion'])) 
        include_once('../paginador.php');
?>