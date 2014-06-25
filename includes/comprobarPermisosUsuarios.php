<?php

function comprobarUsuarioPermiso($tabla,$permiso,$index){
	
	$idusuario = $_SESSION['idusuario_aut'];
	$idgrupo = $_SESSION['grupo_aut'];
	$resultado_permisos;
	if($permiso==''){
		$sql_permiso = "SELECT * 
				FROM usuarios u,grupos_usuarios gu,tablas_permisos tp,permisos p,tablas t
				WHERE u.idgrupousuario = gu.idgrupo
				AND gu.idgrupo = tp.idgrupo
				AND tp.idpermiso = p.idpermiso
				AND tp.idtabla = t.idtabla
				AND u.idusuario = '$idusuario' 
				AND gu.idgrupo = '$idgrupo'
				AND t.nombre_tabla = '$tabla';";
		//echo $sql_permiso;		
		$resultado_permisos= mysql_query($sql_permiso);
		$_SESSION['alta']="";
		$_SESSION['modificar']="";
		$_SESSION['eliminar']="";
		$_SESSION['ver']="";
		while($valores = mysql_fetch_array($resultado_permisos)){
			if($valores['permiso']=='ALTA'){
				$_SESSION['alta']='alta';
			}elseif($valores['permiso']=='ELIMINAR'){
				$_SESSION['eliminar']='eliminar';
			}elseif($valores['permiso']=='MODIFICAR'){
				$_SESSION['modificar']='modificar';
			}else{
				$_SESSION['ver']='ver';
			}
		}
	}else{
		$sql_permiso = "SELECT * 
				FROM usuarios u,grupos_usuarios gu,tablas_permisos tp,permisos p,tablas t
				WHERE u.idgrupousuario = gu.idgrupo
				AND gu.idgrupo = tp.idgrupo
				AND tp.idpermiso = p.idpermiso
				AND tp.idtabla = t.idtabla
				AND u.idusuario = '$idusuario' 
				AND gu.idgrupo = '$idgrupo'
				AND t.nombre_tabla = '$tabla'
				AND p.permiso ='$permiso';";
		$resultado_permisos= mysql_query($sql_permiso);	
	}
	
	$num_registros_permisos = mysql_num_rows($resultado_permisos);
	//echo 'NUMEROPER:'.$num_registros_permisos;
	//echo $sql_permiso;
	if(!$num_registros_permisos >=1){
		if($_SESSION['idusuario_aut']==1){//al administrador no se le bloquea	
		}else{
			if($index){
			}else{
				echo '<p align="center" style="color:#FF0000"><b>Ha realizado una operacion no permitida.<br> 
			Su usuario será bloqueado.<br>
			Consulte con el administrador para desbloquear este usuario.</b></p>';
			
			$sql_bloquea_usuario = "UPDATE usuarios SET bloqueado =1 
									WHERE idusuario ='{$_SESSION['idusuario_aut']}';";
			$result_bloquea_usuario = mysql_query($sql_bloquea_usuario)or die("Error al bloquear el usuario".mysql_error());
			//mandar mail administrador
			/*****************************************************/
			$accion = ereg_replace("'","","USUARIO ".$_SESSION['usuario_aut']." BLOQUEADO");
			insertarLog($accion,true);	
			}	
		}
	}
		
	return $num_registros_permisos;
}


?>