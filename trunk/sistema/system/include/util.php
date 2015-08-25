<?php

    function sql_error_msg() {
        print '<p class="message error">'.mysql_error().'</p>';
    }
    
    function error_msg($msg) {
        print '<p class="message error">'.$msg.'</p>';
    }
    
    function alert_msg($msg) {
        print '<p class="message alert">'.$msg.'</p>';
    }
    
    function success_msg($msg) {
        print "<p>$msg</p>";
    }
    
    function verficar_talonario() {
        $query = "INSERT INTO movimientos (
                fecha,
                usuario,
                tipo,
                operacion
            ) VALUES ( 
                now(),
                ".$_COOKIE['usuario'].",
                ".$operacion.",
                ".$codigo."
            )";
        if (!mysql_query($query)) {
            return false;
        }
        return true;
    }

    function verificar_sql($String) {
        $String = stripslashes($String);
        $String = str_replace("\\", "&bsol;", $String);
        $String = str_replace("/", "&sol;", $String);
        $String = str_replace("'", "&apos;", $String);
        $String = str_replace('"', "&quot;", $String);
        return $String;
    }
    
    function registrar_movimiento($operacion, $codigo, $monto = 0) {
        $query = "INSERT INTO movimientos (
                fecha,
                usuario,
                tipo,
                operacion,
                monto
            ) VALUES ( 
                now(),
                ".$_COOKIE['usuario'].",
                ".$operacion.",
                ".$codigo.",
                ".$monto."
            )";
        if (!mysql_query($query)) {
            return false;
        }
        return true;
    }
    
    function rotateDate($Date) {
        if (strstr($Date, '/')) {
            $date = explode('/', $Date);
            return $date[2].'/'.$date[1].'/'.$date[0];
        }
        else {
            $date = explode('-', $Date);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }
    
    function sql_date_format($Date) {
        $date = explode('/', $Date);
        return $date[2].'-'.$date[1].'-'.$date[0];
    }

    function listadoAgrupado($query, $NombreCampos, $Alineacion = null, $AnchoCelda = null) {
	$return = mysql_query($query);
	if (!$return) {
	    print "<p>Ha ocurrido un error al intentar consultar la información en la base de datos.</p>";
	    print "<p>ERROR EN LA CONSULTA:\n\n".$query."\n\n".htmlspecialchars_decode(mysql_error())."</p>";
	    return;
	}
	if (mysql_num_rows($return) < 1) {
	    print "<p class='info'>La consulta no contiene datos.</p>";
	    return;
	}
	$Limit = count($NombreCampos);
	$Categoria = "";
	$Toggle = 0;
	while ($Row = mysql_fetch_array($return)) {
	    if ($Categoria != $Row[0]) {
		if ($Categoria != "") {
		    print "<tfoot class='ui-widget-header'><tr>";
		    for ($i = 1; $i < $Limit; $i++)
			print "<td></td>";
		    print "</tr></tfoot></table><br><br>";
		}
		print "<h3>".ucfirst($Row[0])."</h3>";
		print "<table class='tabla-datos' cellspacing='0' cellpadding='2'>";
		print "<thead class='ui-widget-header'><tr>";
		for ($i = 1; $i < $Limit; $i++)  
		    print "<th class='header'>".$NombreCampos[$i]."</th>";
		print "</tr></thead>";
		$Categoria = $Row[0];
		$Toggle = 0;
	    }
	    print '<tr class="';
	    $Toggle++ % 2 == 0 ? print "even" : print "odd";
	    print '">';
	    for ($i = 1; $i < $Limit; $i++) {
		print "<td";
		if (isset($Alineacion))
		    print " align='".$Alineacion[$i]."'";
		if (isset($AnchoCelda))
		    print " width='".$AnchoCelda[$i]."'";
		$Field = $Row[$i];
                if (mysql_field_type($return, $i) == "datetime") {
                    $Date = split(" ", $Field);
                    $Field = rotateDate($Date[0])." ".$Date[1];
                }
		print ">".$Field."</td>";
	    }
	    print "</tr>";
	}
	print "<tfoot class='ui-widget-header'><tr>";
	for ($i = 1; $i < $Limit; $i++)
	    print "<td></td>";
	print "</tr></tfoot></table><br><br>";
    }
    
    function listadoLineal($query, $NombreCampos, $Alineacion = null, $AnchoCelda = null) {
	$return = mysql_query($query);
	if (!$return) {
	    print "<p>Ha ocurrido un error al intentar consultar la información en la base de datos.</p>";
	    print "<p>ERROR EN LA CONSULTA:\n\n".$query."\n\n".htmlspecialchars_decode(mysql_error())."</p>";
	    return;
	}
	if (mysql_num_rows($return) < 1) {
	    print "<p class='info'>La consulta no contiene datos.</p>";
	    return;
	}
	$Limit = count($NombreCampos);
	print "<table class='tabla-datos' cellspacing='0' cellpadding='2'>";
	print "<thead class='ui-widget-header'><tr>";
	for ($i = 0; $i < $Limit; $i++) {
            print "<th class='header'>" . $NombreCampos[$i] . "</th>";
        }
        print "</tr></thead>";
	$Toggle = 0;
	while ($Row = mysql_fetch_array($return)) {
	    print '<tr class="';
	    $Toggle++ % 2 == 0 ? print "even" : print "odd";
	    print '">';
	    for ($i = 0; $i < $Limit; $i++) {
		print "<td";
		if (isset($Alineacion)) {
		    print " align='".$Alineacion[$i]."'";
                }
		if (isset($AnchoCelda)) {
		    print " width='".$AnchoCelda[$i]."'";
                }
                $Field = $Row[$i];
                if (mysql_field_type($return, $i) == "datetime") {
                    $Date = split(" ", $Field);
                    $Field = rotateDate($Date[0])." ".$Date[1];
                }
		print ">".$Field."</td>";
	    }
	    print "</tr>";
	}
	print "<tfoot class='ui-widget-header'><tr>";
	for ($i = 0; $i < $Limit; $i++)
	    print "<td></td>";
	print "</tr></tfoot></table><br>";
    }
    
    function listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion = null, $AnchoCelda = null) {
	$return = mysql_query($query1);
	if (!$return) {
	    print "<p>Ha ocurrido un error al intentar consultar la información en la base de datos.</p>";
	    print "<p>ERROR EN LA CONSULTA:\n\n".$query1."\n\n".htmlspecialchars_decode(mysql_error())."</p>";
	    return;
	}
	if (mysql_num_rows($return) < 1) {
	    print "<p class='info'>La consulta no contiene datos.</p>";
	    return;
	}
	while ($Row = mysql_fetch_array($return)) {
	    print "<div class='grupo-informe'>";
	    $i = 0;
	    foreach ($Etiquetas as $Etiqueta) {
		print "<p><label class='etiqueta'>".$Etiqueta.":</label><label class='dato'>".$Row[$i++]."</label></p>";
	    }
	    $CurrentQuery = str_replace('|*-*|', $Row[0], $query2);
	    listadoLineal($CurrentQuery, $NombreCampos, $Alineacion, $AnchoCelda);
	    print "</div>";
	}
    }
    
?>