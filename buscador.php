<?php

include 'mostrar_catalogo.php';

require 'menu_productos.php';

echo '<div id="catalogo">';

$busquedas=explode(' ', $_POST['texto_buscar']);
/*
$tablas=array('catalogos','fabricantes','clases','tipos','familias');
$alias=array('c','f','cl','ti','fa');
*/

$tablas=array('catalogos');
$alias=array('c');

$num_campos=count($tablas);
$num_busquedas=count($busquedas);


//vamos a mirar si alguna de las palabras es una marca la quitamos y condicionamos la búsquda

for($i=0;$i<$num_busquedas;$i++)
{
	$sql="SELECT idfabricante FROM fabricantes WHERE fabricante  ='".$busquedas[$i]."';";
	$consulta=mysql_query($sql);
	if(mysql_num_rows($consulta)>0)
	{
		$resultado=mysql_fetch_row($consulta);
		$idfabricante=$resultado[0];
		$sql_fab=" idfabricante = '$idfabricante' AND ";
	}
	else
	{
		if($busqueda_nueva)
		{
			$busqueda_nueva[]=$busquedas[$i];
		}
		else
		{
			$busqueda_nueva=array();
			$busqueda_nueva[]=$busquedas[$i];
		}
	}		
}

$num_busquedas=count($busqueda_nueva);


for($j=0;$j<$num_campos;$j++) 
{
	$sql = "SELECT * FROM ".$tablas[$j]." ".$alias[$j]." WHERE $sql_fab ";
	
	if($num_busquedas)
	{
	
		for($i=0;$i<$num_busquedas;$i++)
		{
			if($i==0)
			{
				$sql .= '(';
			}
			
			$sql .= $alias[$j].".".substr($tablas[$j],0,-1)." LIKE '%".$busquedas[$i]."%'";
			
			if($i>=($num_busquedas-1))
			{
				$sql .= ')';
			}
			else 
			{
				$sql .= ' AND ';
			}	
		}
		
		$sql .= ' OR ';
		
		for($i=0;$i<$num_busquedas;$i++)
		{
			if($i==0)
			{
				$sql .= '(';
			}
			
			$sql .= $alias[$j].".descripcion LIKE '%".$busquedas[$i]."%'";
			
			if($i>=($num_busquedas-1))
			{
				$sql .= ')';
			}
			else 
			{
				$sql .= ' AND ';
			}	
		}
		
	}
	else 
	{
		$sql=substr($sql, 0,-5);
	}
	
	$sql .= " ORDER BY ".substr($tablas[$j],0,-1).";";
	
}

mostrar_catalogo($sql,$idfabricante,"buscador");

echo '
</div>
';

?>