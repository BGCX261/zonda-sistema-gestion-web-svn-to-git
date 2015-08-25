<!DOCTYPE HTML>
<html>
    <head>
        <title>Gestión Web</title>
        <meta name="generator" content="Komodo Edit 7">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2013-01-06T00:43:51-0300">
        <meta name="keywords" content="sistema, gestión, web, online, administración, negocio, ventas, compras, php, javascript, mysql">
        <meta name="description" content="Sistema de gestión en línea para negocios y empresas">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <link href="styles/flat/style.css" rel="stylesheet" type="text/css">
        <link href="styles/flat/controls.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor" align="center" style="margin-top: 50px">
            <div id="cuadroIngreso">
                <div id="formularioIngreso" style="margin-top: 120px;">
                    <h1><img src="images/logo-300.png"></h1>
                    <p>
                        <?php
                            if (!isset($_POST['upload'])) {
                        ?>
                        <h1>Recuperaci&oacute;n de datos</h1>
                        <p id='mensaje-error'>Atenci&oacute;n! La informaci&oacute;n actualmente almacenada ser&aacute; eliminada en forma permanente al cargar el archivo.</p>
                        <br />
                        <form action="recuperar.php" method="post" enctype="multipart/form-data" class="formulario">
                            <input id="archivo" name="archivo" type="file" size="30" class="campo campo-entrada campo-flat" style="margin: 10px auto;" />
                            <br />
                            <input id="enviar" name="enviar" type="submit" value="Cargar archivo" class="boton boton-flat" />
                            <input id="upload" name="upload" type="hidden" value="upload" />
                        </form>
                        <p>
                        <?php
                            }
                            else {
                                
                                if ($_FILES['archivo']['size'] > 0) {
                                
                                    print '<b>Iniciando la recuperación de datos...</b><br /><br />';
                                    
                                    $Archivo = $_FILES['archivo']['name'];
                                    $TmpName = $_FILES['archivo']['tmp_name'];
                                    $Tamaño = $_FILES['archivo']['size'];
                                    $TipoArchivo = $_FILES['archivo']['type'];
                                    
                                    include_once('include/conexion.php');
                                    
                                    Conexion::conectar();
                                    
                                    $Fp = fopen($TmpName, 'r');
                                    $TotalRegistros = 0;
                                    
                                    while(!feof($Fp)) {
                                        $Consulta = fgets($Fp);
                                        if ($Consulta != "\n" && !strstr($Consulta, '--')) {
                                            $Registros = 0;
                                            do {
                                                $Consulta .= fgets($Fp);
                                                $Registros++;
                                            } while (!feof($Fp) && !strstr($Consulta, ';'));
                                            if ($Consulta != '') {
                                                $Result = mysql_query($Consulta);
                                                if (!$Result) {
                                                    print "Ha ocurrido un error al intentar grabar la información en la base de datos: <br><br>".mysql_error();
                                                    return;
                                                }
                                                if (strstr($Consulta, 'INSERT')) {
                                                    $TotalRegistros += $Registros;
                                                    print $TotalRegistros.' registros procesados...<br />';
                                                }
                                            }
                                        }
                                    }
                                    
                                    fclose($Fp);
                                    print '<br /><h1>Se ha recuperado la base de datos!</h1>';
                                    
                                }
                                else {
                                    print 'Hubo un error en la carga del archivo.';
                                }
                                
                            }
                        ?>
                        </p>
                    </p>
                </div>
            </div>
        </div>
        <div id="dialogo-alerta" title="Gestion Web dice:">
            <p align="center"></p>
        </div>
    </body>
</html>
