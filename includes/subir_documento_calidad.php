<?php


function subir_fichero($k,$ruta,$nombre_total)
{
	
	if (move_uploaded_file($_FILES[$k]['tmp_name'], $ruta.$nombre_total))
	{

		//unlink ($ruta.$nombre_temporal);
		
		$error_archivo=false;
	}
	else
	{
		$error_archivo=true;
	}

	return $error_archivo;

}


//subida de ficheros
print_r($_POST);
$ruta='./documentos_calidad/';//ruta de los adjuntos
$tamano_max_archivo=10000000;//tamano de los adjuntos
$existen_dos = false;

echo "<br>ruta = $ruta";
echo "<br>tamaño de fichero = $tamano_max_archivo_noticia<br>";

$cuenta=1;//si necesitamos saber nº o poner un nº en el nombre

//problema con otros archivos adjuntos

foreach ($_FILES as $k=>$v)
{
//	print_r($_FILES[$k]);

	$nombre_archivo = $_FILES[$k]['name'];
	$tipo_archivo = $_FILES[$k]['type'];
    
    $j=substr($k,-1,1);
	
	if ($nombre_archivo != '' && strstr($tipo_archivo, "image")) //para un futuro trabajar con flash, video, etc.
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
		
	 	$nombre_archivo=$_FILES[$k]['name'];
		
		$tamano_archivo = $_FILES[$k]['size'];
		
		unset($ext);
		
		$documento_invertida=strrev($nombre_archivo);
		$ext_invertida=substr($documento_invertida,0,3);
		$ext=strrev($ext_invertida);
		
		if($tamano_archivo>$tamano_max_archivo)
		{
		 	unset($ext);
			echo "El tamaño de los archivos no es correcto. <br><br>";
			$error_archivo=true;
			
		}
			 
		if ($ext)
		{
			$nombre_temporal='temporal'.$ext;//se puede cambiar por necesidad especial
			
			//$nombre_total=$id_noticias.'_'.$cuenta.$ext;
			
			//require nombrearchivo para quitar ñ, acentos y espacios y otros caracteres raros
			
			//$nombre_total=$nombre_archivo;//si usamos el nombre original incluye la extension
            
			
            $nombre_total=$nombre_archivo.'.'.$ext;//el tipo del documento te lo llevas
            /*
			$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_.";
			 
		   	for ($i=0; $i<strlen($nombre_total); $i++)
			{ 
				$pos=strpos($permitidos, substr($nombre_total,$i,1));
				//echo "Pos=$pos<br>";
		    	if ($pos===false)
				{ 
					echo "$nombre_total no es válido. No use acentos, ñ ni espacios.<br>"; 
		        	//existe la posibilidad de sustituir los acentos por vocales solas, ñ pòr n y espacio por _
		        	$error_archivo=true; 
		      	} 
		      	
		   	}
		   	*/
		   	//esto depende del objetivo que se desee, en BBDD normalmente interesa sustitucion
			//por defecto sustituye la imagen por la nueva, hemos de saberlo por si necesitamos BBDD
			
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
				echo "error_archivo=$error_archivo<br>";
			}
		}
		
		
		//NO METO EN BASE DATOS
		//CORREGIR DE AQUI PARA ABAJO
		//QUE NO SE ME PASE
		
		if ($error_archivo==true)
		{
			echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
		}
		else
		{
			if($exite_ya)
			{
				
				echo "El documento $ruta $nombre_total se ha sustituido correctamente al servidor.<br>";	
				
			}
			else
			{

                if($_POST['documento_fisico']!='')
                {
                    $ruta_fisica = "'".$_POST['documento_fisico']."'";
                    $existen_dos = true;
                }
                else
                {
                    $ruta_fisica = 'NULL';
                    $existen_dos = false;
                }
                
                $codigo_documento=$_POST['cod_documento'];
                $nombre_documento = $_POST['nombre_documento'];
                $revision__vigente = $_POST['revision__vigente'];
                $fecha_edicion = formateoFecha($_POST['fecha_edicion']);
                $ruta = $ruta.$nombre_total;
                //inserto los datos relativos a los docomentos.
                $adjunto_sql="INSERT INTO documentos_calidad (cod_documento, nombre_documento, revision_vigente, fecha_edicion, 
                                                              ubicacion_documento_electronico, ubicacion_documento_fisico)
                                                  VALUES ('$codigo_documento','$nombre_documento','$revision_vigente','$fecha_edicion',
                                                          '$ruta',$ruta_fisica);"; 
                echo '<br>'.$adjunto_sql;
                $insertar_archivo=mysql_query($adjunto_sql)or die('Error el insertar el archivo adjunto la documentacion: ' . mysql_error());
				
				if($existen_dos == true)
                {
                  echo "El documento $ruta $nombre_total se ha subido correctamente al servidor y su ruta fisica ha sido actualizada.<br>";  
                }
                else
                {
                   echo "El documento $ruta $nombre_total se ha subido correctamente al servidor.<br>"; 
                }
                
              //  echo "La consulta es: $adjunto_sql";
				
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
	}
	$cuenta++;
}

?>