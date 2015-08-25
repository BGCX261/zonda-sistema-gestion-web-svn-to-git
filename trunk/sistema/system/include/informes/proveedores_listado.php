<?php

    include ('include/util.php');
    
    print '<h1>Listado general de proveedores</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
        
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'proveedores.codigo',
                'nombre' => 'Código'
            ),
            array(
                'valor' => 'proveedores.razon',
                'nombre' => 'Razón'
            ),
            array(
                'valor' => 'proveedores.domicilio',
                'nombre' => 'Domicilio'
            ),
            array(
                'valor' => 'proveedores.telefono',
                'nombre' => 'Teléfono'
            ),
            array(
                'valor' => 'localidades.localidad',
                'nombre' => 'Localidad'
            ),
            array(
                'valor' => 'proveedores.pagina',
                'nombre' => 'Página Web'
            ),
            array(
                'valor' => 'proveedores.correo',
                'nombre' => 'Correo Electrónico'
            ),
            array(
                'valor' => 'proveedores.saldo',
                'nombre' => 'Saldo'
            )
        );
        
        include ('include/form_informe.php');
        
    }
    
    $query = "
        SELECT
            LPAD(proveedores.codigo, 11, 0),
            proveedores.razon,
            proveedores.domicilio,
            proveedores.telefono,
            localidades.localidad,
            proveedores.pagina,
            proveedores.correo,
            proveedores.saldo
        FROM
            proveedores,
            localidades 
        WHERE
            localidades.codigo = proveedores.localidad ";
    
    $CriterioOrden = 'proveedores.codigo';
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Razón Social', 'Domicilio', 'Teléfono', 'Localidad', 'Página', 'Correo', 'Saldo');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('10%', '20%', '15%', '10%', '15%', '10%', '10%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>