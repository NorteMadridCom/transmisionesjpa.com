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
//print_r($_POST);
$ruta='documentacion/'.$_POST['referencia_expediente'].'/'.$_POST['referencia_expediente'].'-'.$_POST['codigo_accion'].'/'.$_POST['referencia_expediente'].'-'.$_POST['codigo_accion'].'-'.$_POST['grupo'].'/'.$_POST['nif'].'/';//ruta de los adjuntos
$tamano_max_archivo=10000000;//tamano de los adjuntos

//echo "<br>ruta = $ruta";
//echo "<br>tamaño de fichero = $tamano_max_archivo_noticia<br>";

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
            /*
            echo '<p>La K:';
            print_r($k);
            echo '</p>';
			*/
            if($k=='documento_subir_convocatoria'.$j)
            {
                $subnombre=$_POST['idtipo_documento_convocatoria'.$j].'_convocatoria';
            }
            elseif($k=='documento_subir'.$j)
            {
                $subnombre=$_POST['idtipo_documento'.$j];
            }
            
          //  echo 'subnombre: '.$subnombre;
            $nombre_total=$_POST['nif_alumno'].'_'.$subnombre.'.'.$ext;//el tipo del documento te lo llevas
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
				//echo "error_archivo=$error_archivo<br>";
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
				
				echo "Los documentos han sido sustituido correctamente en su actual ubicación en el servidor.<br>";	
				
			}
			else
			{

                if($k=='documento_subir_convocatoria'.$j)
                {
                    $tabla='documentacion_convocatoria';
                    $iddocumentacion="iddocumentacion_convocatoria='".$_POST['iddocumentacion_convocatoria'.$j]."'";
                }
                elseif($k=='documento_subir'.$j)
                {
                    $tabla='documentacion';
                    $iddocumentacion="iddocumentacion='".$_POST['iddocumentacion'.$j]."'";
                }
                    
                
            
               $adjunto_sql="UPDATE $tabla SET nombre_archivo='".$nombre_total."' WHERE $iddocumentacion ;";
               
                $insertar_archivo=mysql_query($adjunto_sql)or die('Error el insertar el archivo adjunto la '.$tabla.': ' . mysql_error());
				
				echo "Los documentos han sido subido correctamente al servidor.<br>";
                //echo "La consulta es: $adjunto_sql";
				
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