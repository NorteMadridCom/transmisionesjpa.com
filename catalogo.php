<?php

require 'mostrar_catalogo.php';
require 'menu_productos.php';
require 'catalogo_nuevo.php';
?>

<div style="width: 100%; min-width: 320px; max-width: 1000px; margin: 0 auto;">

<?php

if ($_GET['seccion']!="productos") {
	echo '<a href="?seccion=productos" class="titulos_menu_cabecera">Visulizar los catálogos por categorias</a><br>';
	$menu='fabricantes';
} else {
	echo '<a href="?seccion=fabricantes" class="titulos_menu_cabecera">Visulizar los catálogos por Marcas</a><br>';
	$menu='familias';
}


$catalogo = new Catalogo();
if($_GET['catalogo']) $catalogo->ficha($_GET['catalogo'],'catalogos');
elseif ($_GET['clase']) $catalogo->ficha($_GET['clase'],'clases');
elseif ($_GET['tipo']) $catalogo->ficha($_GET['tipo'],'tipos');
elseif ($_GET['familia']) $catalogo->ficha($_GET['familia'],'familias');  
elseif ($_GET['fabricante']) $catalogo->ficha($_GET['fabricante'],'fabricantes');  
else $catalogo->menu($menu);

?>

</div>