<?php

function insertarLog($accion,$fin){
	/*
	El campo $accion es la sql que esta realizando el usuario.
	El campo $fin es un booleano que sirve para saber si realemente se necesita la 
	fecha final para hacer la insercion en el log.Si no la ponemos por defecto a null.
	***************************************************************************/
	$fecha_actual= $_SESSION['fecha_sesion'];
	if($fin){
		$fecha_fin ="'".date("Y-m-d H:i:s")."'";
	}else{
		$fecha_fin ='null';
	} 
	
	$accion = ereg_replace("'","",$accion);
	//echo $accion;
	$logs_insert="INSERT INTO logs (fecha_inicio,idusuario,ip,accion,fecha_fin)
				VALUES('$fecha_actual','{$_SESSION['idusuario_aut']}','{$_SESSION['ip_aut']}',
					'$accion',$fecha_fin);";
	//echo $logs_insert;
	mysql_query($logs_insert)or die("Error al introducir en el log. ".mysql_error());
	/**************************************************************************/

}
?>