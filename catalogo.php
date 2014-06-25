<?php

require 'mostrar_catalogo.php';

require 'menu_productos.php';

echo '<div id="catalogo">';


if($_GET['idclase'] || $_GET['idfabricante'])
{
	if($_GET['idclase'])
	{
		$sql_clase=" AND idclase='{$_GET['idclase']}' ";
		
		//presentacion del tipo (si procede y no es cat�logo directo)
		$sql_clase_general="SELECT * FROM clases WHERE eliminado=0 AND idclase='{$_GET['idclase']}';";
		$consulta_clase_general=mysql_query($sql_clase_general) or die ("<p>No se puede ejecutar la consulta de las clases: ". mysql_error() ."La consulta es: $sql_clase_general.</p>");
		$resultado_clase_general=mysql_fetch_assoc($consulta_clase_general);
		if($resultado_clase_general['clase']=="0") 
		{
			$sql_tipo="SELECT * FROM tipos WHERE eliminado=0 AND idtipo='{$_GET['idtipo']}';";
			$consulta_tipo=mysql_query($sql_tipo) or die ("<p>No se puede ejecutar la consulta de los tipos: ". mysql_error() ."La consulta es: $sql_tipo.</p>");
			$resultado_tipo=mysql_fetch_assoc($consulta_tipo);
			if($resultado_tipo!='0') 
			{
				if($resultado_tipo['imagen'] || $resultado_tipo['documento_tipo']) 
				{
					echo '<h2>'.$resultado_tipo['tipo'].'</h2>';
					if ($resultado_tipo['documento_tipo'])
					{
						echo '<center><a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_tipo['documento_tipo'].'">Descargar PDF</a></center></br>';
					}
					if ($resultado_tipo['imagen'])
					{
						echo '<div id="img_prodc_general"><img src="images/catalogo/'.$resultado_tipo['imagen'].'" /></div>';
					}
				}
			}
			else 
			{
				$sql_familia="SELECT * FROM familias WHERE eliminado=0 AND idfamilia='{$_GET['idfamilia']}';";
				$consulta_familia=mysql_query($sql_familia) or die ("<p>No se puede ejecutar la consulta de los familias: ". mysql_error() ."La consulta es: $sql_familia.</p>");
				$resultado_familia=mysql_fetch_assoc($consulta_familia);
				if($resultado_familia['imagen'] || $resultado_familia['documento_familia']) 
				{
					echo '<h2>'.$resultado_familia['familia'].'</h2>';
					if ($resultado_familia['documento_familia'])
					{
						echo '<center><a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_familia['documento_familia'].'">Descargar PDF</a></center></br>';
					}
					if ($resultado_familia['imagen'])
					{
						echo '<div id="img_prodc_general"><img src="images/catalogo/'.$resultado_familia['imagen'].'" /></div>';
					}
				}
			}
		
		}
		else
		{
			if($resultado_clase_general['imagen'] || $resultado_clase_general['documento_clase']) 
			{
				echo '<h2>'.$resultado_clase_general['clase'].'</h2>';
				if ($resultado_clase_general['documento_clase'])
				{
					echo '<center><a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_clase_general['documento_clase'].'">Descargar PDF</a></center></br>';
				}
				if ($resultado_clase['imagen'])
				{
					echo '<div id="img_prodc_general"><img src="images/catalogo/'.$resultado_clase_general['imagen'].'" /></div>';
				}
			}
		}
		
	}
	if($_GET['idfabricante'])
	{
		$sql_marca=" AND idfabricante='{$_GET['idfabricante']}' ";
	}
	
	$sql_catalogo="SELECT * FROM catalogos WHERE eliminado=0 $sql_clase $sql_marca ORDER BY catalogo;";
	mostrar_catalogo($sql_catalogo,$_GET['idfabricante']);
}
elseif($_GET['idtipo'])
{
	//presentacion del tipo (si procede y no es cat�logo directo)
	$sql_tipo="SELECT * FROM tipos WHERE eliminado=0 AND idtipo='{$_GET['idtipo']}';";
	$consulta_tipo=mysql_query($sql_tipo) or die ("<p>No se puede ejecutar la consulta de los tipos: ". mysql_error() ."La consulta es: $sql_tipo.</p>");
	$resultado_tipo=mysql_fetch_assoc($consulta_tipo);
	if($resultado_tipo!='0') 
	{
		if($resultado_tipo['imagen'] || $resultado_tipo['documento_tipo']) 
		{
			echo '<h2>'.$resultado_tipo['tipo'].'</h2>';
			if ($resultado_tipo['documento_tipo'])
			{
				echo '<center><a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_tipo['documento_tipo'].'">Descargar PDF</a></center></br>';
			}
			if ($resultado_tipo['imagen'])
			{
				echo '<div id="img_prodc_general"><img src="images/catalogo/'.$resultado_tipo['imagen'].'" /></div>';
			}
		}
		else 
		{
			echo '<h2>Productos General</h2>
				<div id="img_prodc_general"><img src="images/productos2.png"></div>';
		}
	}
	else 
	{
		$sql_familia="SELECT * FROM familias WHERE eliminado=0 AND idfamilia='{$_GET['idfamilia']}';";
		$consulta_familia=mysql_query($sql_familia) or die ("<p>No se puede ejecutar la consulta de los familias: ". mysql_error() ."La consulta es: $sql_familia.</p>");
		$resultado_familia=mysql_fetch_assoc($consulta_familia);
		if($resultado_familia['imagen'] || $resultado_familia['documento_familia']) 
		{
			echo '<h2>'.$resultado_familia['familia'].'</h2>';
			if ($resultado_familia['documento_familia'])
			{
				echo '<center><a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_familia['documento_familia'].'">Descargar PDF</a></center></br>';
			}
			if ($resultado_familia['imagen'])
			{
				echo '<div id="img_prodc_general"><img src="images/catalogo/'.$resultado_familia['imagen'].'" /></div>';
			}
		}
		else 
		{
			echo '<h2>Productos General</h2>
				<div id="img_prodc_general"><img src="images/productos2.png"></div>';
		}
	}
}

elseif($_GET['idfamilia'])
{
	$sql_familia="SELECT * FROM familias WHERE eliminado=0 AND idfamilia='{$_GET['idfamilia']}';";
	$consulta_familia=mysql_query($sql_familia) or die ("<p>No se puede ejecutar la consulta de los familias: ". mysql_error() ."La consulta es: $sql_familia.</p>");
	$resultado_familia=mysql_fetch_assoc($consulta_familia);
	if($resultado_familia['imagen'] || $resultado_familia['documento_familia']) 
	{
		echo '<h2>'.$resultado_familia['familia'].'</h2>';
		if ($resultado_familia['documento_familia'])
		{
			echo '<center><a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_familia['documento_familia'].'">Descargar PDF</a></center></br>';
		}
		if ($resultado_familia['imagen'])
		{
			echo '<div id="img_prodc_general"><img src="images/catalogo/'.$resultado_familia['imagen'].'" /></div>';
		}
	} elseif($resultado_familia['idfamilia']=='9') {
		echo '<h2>Reductores Gama Industrial</h2>
			<div id="img_prodc_general"><img src="images/productos2.png"></div>
			<h3><a href="http://www.tramec.it/it-it/configuratori/select-by-application.aspx?idC=61680&idO=11269&LN=it-IT" target="_blank">CONFIGURADOR 2D/3D</a></h3>';
	} else {
		echo '<h2>Productos General</h2>
			<div id="img_prodc_general"><img src="images/productos2.png"></div>';
	}
} else {
		
	if($_GET['parte']) require "{$_GET['parte']}.php";
	else require 'productos_general.php';

}

echo '
</div>
';

?>
