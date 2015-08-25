<!DOCTYPE HTML>
<html>
    <head>
        <title>Zonda &rArr; Sistema de gesti&oacute;n web</title>
        <meta name="generator" content="Netbeans IDE 8.0.2">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2015-02-19T00:19:51-0300">
        <meta name="keywords" content="sistema, gestión, web, online, administración, negocio, ventas, compras, php, javascript, mysql">
        <meta name="description" content="Sistema de gestión en línea para negocios y empresas">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link href="styles/original/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="barra-herramientas">

            <!--<ul class="menu-herramientas">

                <li>Agregar campo</li>

            </ul>-->

        </div>

        <div class="hoja-factura">

            AAA

        </div>
        
        <div id="menu_principal" class="menu_principal">

            <!--<h1>GUI Editor v0.2</h1>>-->
            <div class="boton-desactivado"><a id="disenio">Diseño</a></div>
            <div class="boton-desactivado"><a id="codigo">Código</a></div>
            <div class="boton-desactivado"><a id="estilo">Estilo</a></div>
            <div class="boton"><a id="guardar">Guardar</a></div>
            <div class="boton"><a id="cargar">Cargar</a></div>
            <div class="info">
                <a id="cambiarNombre">
                    <form>
                        <label>&nbsp;</label>
                        <input type="text" id="nombre" name="nombre" value="" size="20" readonly="true"/>
                        <label>&nbsp;</label>
                    </form>
                </a>
            </div>
            <div class="info">
                <a id="cambiarColor" title="Ctrl+Shift+L">
                    <form>
                        <label>Color:</label>
                        <input type="text" id="color" name="color" value="#FFFFFF" size="10"/>
                    </form>
                </a>
            </div>
            <div id="dialogoColor">
                <div id="colorpicker"></div>
            </div>
            <div class="boton"><a id="agregarImagen" title="Ctrl+Shift+I">Agregar imagen</a></div>
            <div class="boton"><a id="agregarCapa" title="Ctrl+Shift+D">Agregar capa</a></div>
            <div class="boton"><a id="copiarCapa" title="Ctrl+Shift+K">Duplicar capa</a></div>
            <div class="boton"><a id="borrarCapa" title="Retroceso/Suprimir">Borrar capa</a></div>
            <div class="boton"><a id="texto" title="Ctrl+Shift+X">Agregar texto</a></div>
            <div class="boton"><a id="trans" title="Ctrl+Shift+N">Capa transparente</a></div>
            <form>
                <input type="text" id="posicion" name="posicion" value="t: 0 - l: 0" size="19" readonly="true"/><br>
                <input type="text" id="tamanio" name="tamanio" value="w: 0 - h: 0" size="19" readonly="true"/>
            </form>

        </div>

        <div id="paginaDisenio">

            <div id="contenedor" class="block" style="top: 0; left: 0; width: 800px; height: 700px; background-color: #333">
                <!--<div class="handle"></div>-->
                <div class="resize"></div>

            </div>

        </div>
        <div id="paginaCodigo"><TEXTAREA id="textoCodigo" cols="200" rows="120" readonly="true"></TEXTAREA></div>
        <div id="paginaEstilo"><TEXTAREA id="textoEstilo" cols="200" rows="120" readonly="true"></TEXTAREA></div>
        <div id="paginaCarga"></div>

        <div id="imagedialog" class="dialog">

            <div class="dialogtitle">Seleccione una imagen</div>
            <div class="closedialog" onclick="closeDialog()">X</div>
            <div id="dialogbody" class="dialogbody"></div>

        </div>

        <div id="fontdialog" class="dialog">

            <div class="dialogtitle">Seleccione un estilo de fuente</div>
            <div class="closedialog" onclick="closeDialog()">X</div>
            <div id="fontdialogbody" class="dialogbody">
                <br>
                &nbsp;&nbsp;Fuente:&nbsp;
                <SELECT id="font">
                    <option value="serif">serif</option>
                    <option value="sans-serif">sans-serif</option>
                    <option value="monospace">monospace</option>
                </SELECT>
                <br><br>
                &nbsp;&nbsp;Estilo:&nbsp;
                <INPUT id="bold" type="checkbox" value="bold">&nbsp;<b>negrita</b>&nbsp;&nbsp;
                <INPUT id="italic" type="checkbox" value="italic">&nbsp;<i>cursiva</i>&nbsp;&nbsp;
                <INPUT id="underline" type="checkbox" value="underline">&nbsp;<u>subrayado</u>
                <br><br>
                &nbsp;&nbsp;Tamaño:&nbsp;
                <SELECT id="size">
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                    <option value="20">20</option>
                    <option value="24">24</option>
                    <option value="32">32</option>
                    <option value="48">48</option>
                    <option value="56">56</option>
                    <option value="80">80</option>
                </SELECT>
                <br><br>
                &nbsp;&nbsp;<textarea id="text" cols="49" rows="5"></textarea>
                <br>
                &nbsp;&nbsp;<INPUT type="button" id="agregar" class="boton" value="Aceptar"/>
            </div>

        </div>

        <div id="filedialog" class="dialog">

            <div class="dialogtitle">Seleccione un archivo</div>
            <div class="closedialog" onclick="closeDialog()">X</div>
            <div id="filedialogbody" class="dialogbody"></div>
            <div id="filenamediv">
                <INPUT type="text" id="filename" size="40" maxlength="50">
                &nbsp;&nbsp;<INPUT type="button" id="cargarArchivo" class="boton" value="Aceptar"/>
            </div>

        </div>
        
    </body>
</html>