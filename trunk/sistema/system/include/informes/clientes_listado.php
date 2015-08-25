<?php
    
    include ('include/util.php');
    
    print '<h1>Listado general de clientes</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
        
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'clientes.codigo',
                'nombre' => 'Código'
            ),
            array(
                'valor' => 'clientes.razon',
                'nombre' => 'Razón'
            ),
            array(
                'valor' => 'clientes.domicilio',
                'nombre' => 'Domicilio'
            ),
            array(
                'valor' => 'clientes.telefono',
                'nombre' => 'Teléfono'
            ),
            array(
                'valor' => 'localidades.localidad',
                'nombre' => 'Localidad'
            ),
            array(
                'valor' => 'clientes.pagina',
                'nombre' => 'Página Web'
            ),
            array(
                'valor' => 'clientes.correo',
                'nombre' => 'Correo Electrónico'
            ),
            array(
                'valor' => 'clientes.saldo',
                'nombre' => 'Saldo'
            )
        );
        
        include ('include/form_informe.php');
    
    }
    
    $query = "
        SELECT
            LPAD(clientes.codigo, 11, 0),
            clientes.razon,
            clientes.domicilio,
            clientes.telefono,
            localidades.localidad,
            clientes.pagina,
            clientes.correo,
            clientes.saldo
        FROM
            clientes,
            localidades 
        WHERE
            localidades.codigo = clientes.localidad ";
    
    $CriterioOrden = 'clientes.codigo';
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Razón Social', 'Domicilio', 'Teléfono', 'Localidad', 'Página', 'Correo', 'Saldo');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('10%', '20%', '15%', '10%', '15%', '10%', '10%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>