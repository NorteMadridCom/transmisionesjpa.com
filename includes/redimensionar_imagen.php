<?php				

function redimensionar_imagen($k,$anchura,$altura,$ruta,$nombre_total,$nombre_temporal)
{
	
	if (move_uploaded_file($_FILES[$k]['tmp_name'], $ruta.$nombre_temporal))
	{

		$datos = getimagesize($ruta.$nombre_temporal); 
		
		if($datos[2]==1){$img = imagecreatefromgif($ruta.$nombre_temporal);} 
		if($datos[2]==2){$img = imagecreatefromjpeg($ruta.$nombre_temporal);} 
		if($datos[2]==3){$img = imagecreatefrompng($ruta.$nombre_temporal);} 
		
		$ratio_y = $datos[1]/$altura;
		$ratio_x = $datos[0]/$anchura;
		
		if (($ratio_x>=1)||($ratio_y>=1))
		{
			if ($ratio_x >= $ratio_y)
			{
				$ancho_nuevo = $datos[0]/$ratio_x;
				$alto_nuevo = $datos[1]/$ratio_x;
			}
			else
			{
				$ancho_nuevo = $datos[0]/$ratio_y;
				$alto_nuevo = $datos[1]/$ratio_y;
			}
		}
		else
		{
			$ancho_nuevo = $datos[0];
			$alto_nuevo = $datos[1];
		}
		
		$thumb = imagecreatetruecolor($ancho_nuevo,$alto_nuevo); 
		
		imagecopyresampled($thumb, $img, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $datos[0], $datos[1]); 
		
		if($datos[2]==1)
		{
			//header("Content-type: image/gif"); 
			imagegif($thumb,$ruta.$nombre_total);
		} 
		if($datos[2]==2)
		{
			//header("Content-type: image/jpg");
			imagejpeg($thumb,$ruta.$nombre_total);
		} 
		if($datos[2]==3)
		{
			//header("Content-type: image/png");
			imagepng($thumb,$ruta.$nombre_total);
		} 

		unlink ($ruta.$nombre_temporal);
		imagedestroy($thumb);
		
		$error_imagen=false;
	}
	else
	{
		$error_imagen=true;
	}

	return $error_imagen;

}

// $imagen - tratamiento y reduccion
						
//$anchura=100;
//$altura=100;

//tratamiento según tabla configuraciones, se definen las variables primero

//$clase_valor debe estar definido al llamarlo, en BBDD debe existir los campos... ancho_imagen_xxxxxx

$anchura=400;//anchura maxima
$altura=200;//altura maxima
$ruta='images/';//ruta de las imagenes
//$tamano_max_imagen=3;//tamano de las imagenes maximo

//echo $ruta;

$cuenta=0;//si necesitamos saber nº o poner un nº en el nombre
//empezamos en 0 porque esta el archivo adjunto antes
//problema con otros archivos adjuntos

foreach ($_FILES as $k=>$v)
{

	$nombre_archivo = $_FILES[$k]['name'];
	$tipo_imagen = $_FILES[$k]['type'];
	
	if ($nombre_archivo != '' && strstr($tipo_imagen, "image"))
	{
		
		/*
		if ($_POST['imagen_noticias'])
		{
			unlink($ruta.$_POST['imagen_noticias']);
			$sql_modificar_noticia = "UPDATE noticias SET ";
			$sql_modificar_noticia .= " imagen='' ";
			$sql_modificar_noticia .= " WHERE id_noticia='$id_noticias' ;";
	
			$resultado_modificar_noticia=mysql_query($sql_modificar_noticia) or die('Error al borrar la imagen de la noticia: ' . mysql_error());
		}
		*/
		
	 	$nombre_imagen=$_FILES[$k]['name'];
		
		$tamano_imagen = $_FILES[$k]['size'];
		
		unset($ext);
		
		if (strstr($tipo_imagen, "gif"))
		{
			$ext='.gif';
		}
		elseif (strstr($tipo_imagen, "jpeg"))
		{
			$ext='.jpg';
		}
		elseif (strstr($tipo_imagen, "png"))
		{
			$ext='.png';
		}
		else
		{
			echo "La extensión de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg o .png</td></tr></table>";
			$error_imagen=true;
		}
		/*
		if($tamano_imagen>$tamano_max_imagen)
		{
		 	unset($ext);
			echo "El tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg o .png</td></tr></table>";
			$error_imagen=true;
			
		}
		*/	 
		if ($ext)
		{
			$nombre_temporal='temporal'.$ext;//se puede cambiar por necesidad especial
			
			//$nombre_total=$id_noticias.'_'.$cuenta.$ext;
			
			//require nombrearchivo para quitar ñ, acentos y espacios y otros caracteres raros
			
			/*
			
			$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_.";
			
			$error_nombre=false; //comprobamos el nombre, pero es bueno en un principio para no arrastar resultado anterior
			 
		   	for ($i=0; $i<strlen($nombre_total); $i++)
			{ 
				$pos=strpos($permitidos, substr($nombre_total,$i,1));
				//echo "Pos=$pos<br>";
		    	if ($pos===false)
				{ 
					echo "$nombre_total no es válido. No use acentos, ñ ni espacios.<br>"; 
		        	//existe la posibilidad de sustituir los acentos por vocales solas, ñ pòr n y espacio por _
		        	$error_archivo=true;
					$error_nombre=true; 
		      	} 
		      	
		   	}
		   	
		   	//esto depende del objetivo que se desee, en BBDD normalmente interesa sustitucion
			//por defecto sustituye la imagen por la nueva, hemos de saberlo por si necesitamos BBDD
			
			if($error_nombre===false)
			{
			
				$sustituir_archivo=true;
						
				$exite_ya=file_exists($ruta.$nombre_total);		
				
				if (file_exists($ruta.$nombre_total) && $sustituir_archivo==false)
				{ 
				   echo "El documento ya existe.<br>";
				   $error_archivo=true; 
				}
				else
				{
					$error_archivo=subir_fichero($k,$ruta,$nombre_total);
				}
			
			}						
			
			*/
			
			$nombre_total=$nombre_archivo;//si usamos el nombre original incluye la extension
			
			$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_.";
			
			$error_nombre=false; //comprobamos el nombre, pero es bueno en un principio para no arrastar resultado anterior
			
			for ($i=0; $i<strlen($nombre_total); $i++)
			{ 
				$pos=strpos($permitidos, substr($nombre_total,$i,1));
				//echo "Pos=$pos<br>";
		    	if ($pos===false)
				{ 
					echo "$nombre_total no es válido. No use acentos, ñ ni espacios.<br>"; 
		        	//existe la posibilidad de sustituir los acentos por vocales solas, ñ pòr n y espacio por _
		        	$error_archivo=true;
					$error_nombre=true; 
		      	} 
		      	
		   	}
		   	
		   	//esto depende del objetivo que se desee, en BBDD normalmente interesa sustitucion
			//por defecto sustituye la imagen por la nueva, hemos de saberlo por si necesitamos BBDD
		   	
		   	if($error_nombre===false)
				{
			
					$sustituir_imagen=true;
						
					$exite_ya=file_exists($ruta.$nombre_total);		
					
					if (file_exists($ruta.$nombre_total) && $sustituir_imagen==false)
					{ 
					   echo "La imagen ya existe.<br>";
					   $error_imagen=true; 
					}
					else
					{
						$error_imagen=redimensionar_imagen($k,$anchura,$altura,$ruta,$nombre_total,$nombre_temporal);
					}
			
				}	
			
		}
		
		if ($error_imagen==true)
		{
			echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
		}
		else
		{
			//$imagen_sql="UPDATE noticias SET imagen='$nombre_total' WHERE id_noticia='$id_noticias';";
			//$insertar_imagen=mysql_query($imagen_sql)or die('Error el insertar la imagen de la noticia: ' . mysql_error());
			
			//no me tengo el idimagen
			
			
			if(!$exite_ya)
			{
				//el idimagen lleva un numero adosado idimagen1
				if($_POST['idcompania'])
				{
					$eliminar_anterior_sql="SELECT logo FROM companias WHERE idcompania='{$_POST['idcompania']}' ;";
					$eliminar_anterior_consulta=mysql_query($eliminar_anterior_sql) or die ('Fallo en la consulta de eliminacion de la imagen: '.mysql_error());
					$eliminar_anterior_registro=mysql_fetch_array($eliminar_anterior_consulta, MYSQL_ASSOC);
					if($eliminar_anterior_registro['logo'])
					{
						if(!unlink($ruta.$eliminar_anterior_registro['logo']))
						{	
							unlink($ruta.$nombre_total);
							die("Error al eliminar ".$eliminar_anterior_registro['logo'].". No se puede subir el logotipo $nombre_total. <br>");
							
						}
						else
						{
							$imagen_sql="UPDATE companias SET logo='$nombre_total' WHERE idcompania='$_POST['idcompania]';";
							$insertar_imagen=mysql_query($imagen_sql)or die('Error el insertar el logotipo de la compañía: ' . mysql_error()."La consulta es: $imagen_sql");
							echo "El logotipo $nombre_total se ha subido correctamente al servidor.<br>";
						}
						
					}
				}
				else
				{
					//problemas con esto, es un update
					$sql_nueva_imagen="UPDATE companias SET logo='$nombre_total' WHERE idcompania='".mysql_insert_id()."';";
					$insertar_nueva_imagen=mysql_query($sql_nueva_imagen) or die ('Fallo al introducir el nuevo logotipo: '.mysql_error(). "La consulta es: $sql_nueva_imagen.");
				}			
				
			}
			else
			{
				echo "El logotipo $nombre_total se ha sustituido correctamente al servidor.<br>";
			}

			
			/*
			al subir la nueva imagen cambio el dato en SQL:
				- correcto:
					- elimino la imagen anterior si existe (debo consultarla)
					- si no exite imagen anterior o ha sido sustituida no elimino nada
				- incorrecto:
					- elimino la imagen nueva
					- dejo la antigua si existe
					- si es una sustituicion no importa
			*/

			
			//colocar sentencias de SQL o la llamada si es el caso:
			//eliminar imagen anterior (unlink) siempre y cuando no haya sido sustituida
			//poner en la BBDD el nuevo nombre (UPDATE)
			
		}
	//$cuenta++;		
	}
	$cuenta++;	
}

?>