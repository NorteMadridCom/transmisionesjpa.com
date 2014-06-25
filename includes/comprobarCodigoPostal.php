<?php

function comprobarCodigoPostal($_POST){
	
	$error="Correcto";
	
	
	$sql_postal =mysql_query("SELECT * FROM codigos_postales
				 WHERE codigo_postal ='{$_POST['codpostal']}' AND eliminado=0;");
	$existe_codigo =mysql_num_rows($sql_postal);
	
	if ($existe_codigo==0){
		
		$localidad = pasarMay($_POST['localidad']);
		if (!$localidad){
			$error="Localidad";
		}else{
			//insertamos el codigo ya que no existe
			//echo 'LOC'.$localidad;
//			echo "PROVCOD:".$_POST['provincias'];
			$cod_postal=$_POST['codpostal'];
            //$sql_localidad =mysql_query("SELECT * FROM localidades
//					 WHERE localidad LIKE '$localidad' AND eliminado =0;")or die("Error al consultar la localidad.".mysql_error()."<br>La consulta es: $sql_localidad.");
//			$existe_localidad =mysql_num_rows($sql_localidad);
            $idprov = substr($cod_postal,0,2);
            //if ($idprov == $_POST['provincias']){
				$sql_localidad =mysql_query("SELECT * FROM localidades
					 WHERE localidad LIKE '$localidad' AND eliminado =0;")or die("Error al consultar la localidad.".mysql_error()."<br>La consulta es: $sql_localidad.");
				$existe_localidad =mysql_num_rows($sql_localidad);
				
				//echo $existe_localidad;
				if ($existe_localidad==0){
					$insert_localidad = "INSERT INTO localidades (localidad,idprovincia,eliminado) VALUES('$localidad','$idprov',0);";
					mysql_query($insert_localidad)or die("Error al introducir la localidad.");
					$idlocalidad = mysql_insert_id();
					$insert_codigo = "INSERT INTO codigos_postales (codigo_postal,idlocalidad,eliminado) VALUES ('$cod_postal','$idlocalidad',0);";
					mysql_query($insert_codigo)or die("Error al dar de alta el codigo postal.");
					//echo 'Insertado correctamente';	
				}else{
					$resul_localidad =mysql_fetch_array($sql_localidad);
					$idlocalidad= $resul_localidad['idlocalidad'];
					$insert_codigo = "INSERT INTO codigos_postales (codigo_postal,idlocalidad,eliminado) VALUES ('$cod_postal','$idlocalidad',0);";
					mysql_query($insert_codigo)or die("Error al dar de alta el codigo postal.".mysql_error()."<br>La consulta es: $insert_codigo");
				}	
			//}else{
			//	$error="Provincia";
			//}
		}		
	}
return $error;	
}
?>