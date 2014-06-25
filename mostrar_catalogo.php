<?php

function mostrar_catalogo($sql_catalogo,$idfabricante,$origen="catalogo")
{

	$consulta_catalogo=mysql_query($sql_catalogo) or die ("<p>No se ha ejecutado la consulta de catalogo: ".mysql_error()."<br />La consulta es: $sql_catalogo</p>");
	
	$num_result_catalogo=mysql_num_rows($consulta_catalogo);
	if($num_result_catalogo<1)
	{
		if ($origen!="catalogo")
		{
			echo '<p align="center">No hay elementos a mostrar con estos criterios</p>';
		}
		else
		{
			echo '<p align="center">Sección en Obras. Próximamente le ofreceremos el catálogo de estos porductos. No dude en ponerse en contacto con nosotros para facilitarles esta información.</p>';
		}
	}
	else
	{
		$columnas= 3;
		$filas = intval ($num_result_catalogo / $columnas); 
		$ultima_fila= $num_result_catalogo % $columnas;
		
		//hay que solucionar el problema con el numero 1 o los enteros, por ejemplo 3/3=1 y debe ser ultima fila
		if($idfabricante)
		{
			$sql_fabricante="SELECT fabricante FROM fabricantes WHERE idfabricante='$idfabricante';";
			$consulta_fabricante=mysql_query($sql_fabricante);
			$resultado_fabricante=mysql_fetch_row($consulta_fabricante);
			$titulo_tabla=strtoupper($resultado_fabricante[0]);
		}
		else {
			$titulo_tabla="CATÁLOGOS";
		}
		
		echo '	
			<table id="tabla_catalogo">
				<tr>
					<th colspan="6">'.$titulo_tabla.'</th>
				</tr>
		';
		//la tabla original ha de ser de 6 columnas para acoger todas las divisiones
		if($ultima_fila==0 && $filas>0)
		{
			$filas--;
			$ultima_fila=3;
		}
		
		$fila_i=0;
		$columna_i=1;
		while($resultado_catalogo=mysql_fetch_assoc($consulta_catalogo))
		{
			/*
			$catalogo[$fila_i][$columna_i]=$resultado_catalogo['catalogo'];
			$imagen[$fila_i][$columna_i]=$resultado_catalogo['imagen'];
			$documento[$fila_i][$columna_i]=$resultado_catalogo['documento'];
			*/
			if($fila_i<$filas)//filas normales
			{
				if($columna_i<=3)
				{
					//ponemos celda normal
					if($columna_i==1) 
					{
						echo '<tr>';
					}
					echo '
						<td colspan="2">
							<div align="center">
							<div id="fondo_catalogo">
								<div id="titulo_catalogo">'.$resultado_catalogo['catalogo'].'</div>';
					if($resultado_catalogo['descarga_fabricante']) 
					{
						echo '<a class="documento_catalogo" target="_blank" href="'.$resultado_catalogo['descarga_fabricante'].'">Planos 2D/3D</a>';
					} 
					elseif($resultado_catalogo['video']) 
					{
						echo '<a class="documento_catalogo" target="_blank" href="'.$resultado_catalogo['video'].'">Video</a>';
					}
					else 
					{
						echo '<br />';
					}
					echo '
								<a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_catalogo['documento'].'">Descargar PDF</a>
					'; 
					if ($resultado_catalogo['imagen'])
					{
						echo '<div class="imagen_catalogo"><img src="images/catalogo/'.$resultado_catalogo['imagen'].'" /></div>';
					}
					else
					{
						echo '<div class="imagen_catalogo">colocar imagen de imagen no disponible</div>';
					}
					echo '
							</div>
							</div>
						</td>
					';
					if($columna_i>=3) 
					{
						echo '</tr>';
						$fila_i++;
						$columna_i=1;
					}
					else 
					{
						$columna_i++;
					}
				}
			}	
			else 
			{
				if($columna_i<=$ultima_fila)
				{
					$colspan=6/$ultima_fila;
					if($columna_i==1) {echo '<tr>';}
					echo '
						<td colspan="2">
							<div align="center">
							<div id="fondo_catalogo">
								<div id="titulo_catalogo">'.$resultado_catalogo['catalogo'].'</div>';
					if($resultado_catalogo['descarga_fabricante']) 
					{
						echo '<a class="documento_catalogo" target="_blank" href="'.$resultado_catalogo['descarga_fabricante'].'">Planos 2D/3D</a>';
					} 
					elseif($resultado_catalogo['video']) 
					{
						echo '<a class="documento_catalogo" target="_blank" href="'.$resultado_catalogo['video'].'">Video</a>';
					}
					else 
					{
						echo '<br />';
					}
					echo '
								<a class="documento_catalogo" target="_blank" href="pdf/'.$resultado_catalogo['documento'].'">Descargar PDF</a>
					'; 
					if ($resultado_catalogo['imagen'])
					{
						echo '<div class="imagen_catalogo"><img src="images/catalogo/'.$resultado_catalogo['imagen'].'" /></div>';
					}
					else
					{
						echo '<div class="imagen_catalogo">colocar imagen de imagen no disponible</div>';
					}
					echo '
							</div>
							</div>
						</td>
					';
					if($columna_i==$ultima_fila) {echo '</tr>';}
					$columna_i++;
				}
			}
			//echo $fila_i.$columna_i;
		}
		
		echo '
			</table>
		';
	}
}

?>