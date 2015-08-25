
<p class="parametros-informe" align="right">
    <a href="impresion.php?impresion=true&form=include/<?php print $_REQUEST['include']; ?>/<?php print $_REQUEST['form']; ?>&filtro=<?php print $_REQUEST['filtro']; ?>&valor=<?php print $_REQUEST['valor']; ?>&orden=<?php print $_REQUEST['orden']; ?>&direccion=<?php print $_REQUEST['direccion']; ?><?php 
            if (isset($_REQUEST['fecha-inicio']) && isset($_REQUEST['fecha-fin'])) {
                print '&fecha-inicio='.$_REQUEST['fecha-inicio'].'&fecha-fin='.$_REQUEST['fecha-fin'];
            }
            if (isset($_REQUEST['codigo'])) {
                print '&codigo='.$_REQUEST['codigo'];
            }
        ?>" class="boton-informe" >Imprimir</a>
    <a href="exportar.php?impresion=true&form=include/<?php print $_REQUEST['include']; ?>/<?php print $_REQUEST['form']; ?>&filtro=<?php print $_REQUEST['filtro']; ?>&valor=<?php print $_REQUEST['valor']; ?>&orden=<?php print $_REQUEST['orden']; ?>&direccion=<?php print $_REQUEST['direccion']; ?><?php 
            if (isset($_REQUEST['fecha-inicio']) && isset($_REQUEST['fecha-fin'])) {
                print '&fecha-inicio='.$_REQUEST['fecha-inicio'].'&fecha-fin='.$_REQUEST['fecha-fin'];
            }
            if (isset($_REQUEST['codigo'])) {
                print '&codigo='.$_REQUEST['codigo'];
            }
        ?>" class="boton-informe" >Exportar</a>
</p>
