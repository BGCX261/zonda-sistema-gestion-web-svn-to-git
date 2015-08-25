<h2>menú compras</h2>
<ul id="submenu_compras">
   <li>
       <a href="?include=compras&form=form_compra" title="Iniciar una nueva compra">
         <img src='styles/<?php print $sesion->get_style(); ?>/images/nuevo.png' />
         Nueva compra
      </a>
   </li>
    <li>
        <a href="?include=compras&form=listado_compras&inicio=0&cantidad=100&orden=compras.codigo&direccion=DESC" title="Listado de compras realizadas">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/listado.png' />
            Listado de compras
        </a>
    </li>
</ul>