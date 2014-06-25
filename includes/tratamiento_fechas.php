<?php
//require 'perfiles_fns.php';
 
 
 
//Convierto fecha de mysql (aaaa-mm-dd) a formato normal (dd-mm-aaaa) 
function formateoFecha($fecha){
	if ($fecha<>""){
   		$trozos=explode("-",$fecha,3);
   		$fechafinal=$trozos[2]."-".$trozos[1]."-".$trozos[0];
   		return $fechafinal; 
	}
	else{
		return "";
	}
	
}

function formateoFechaGuiones($fecha){
	if ($fecha<>""){
   		$trozos=explode("-",$fecha,3);
   		$fechafinal=$trozos[2]."/".$trozos[1]."/".$trozos[0];
   		return $fechafinal; 
	}
	
}

function formateoFechaBarra($fecha){
	if ($fecha<>""){
   		$trozos=explode("/",$fecha,3);
   		$fechafinal=$trozos[2]."-".$trozos[1]."-".$trozos[0];
   		return $fechafinal; 
	}
	else{
		return "";
	}
	
}

function Valido_fechas($fecha_inicio, $fecha_fin, $fecha_ini_exp, $fecha_fin_exp) // valido las fechas contra las de expediente
{
   		echo '<br>Fecha_inicio='.$fecha_inicio;
		echo '<br>Fecha_fin='.$fecha_fin;
		echo '<br>Fecha_ini_exp='.$fecha_ini_exp;
		echo '<br>Fecha_fin_exp='.$fecha_fin_exp;
		
	if($fecha_inicio < $fecha_ini_exp) //fuera de rango
	{
		?>
	    	<script language="javascript">
				alert('La fecha inicio no puede ser menor que la fecha de alta del					      				  		 expediente.');
			</script>
	     <?
	  return false; 
	}
	//si todo va bien y compruebo lo siguiente
	elseif($fecha_fin > $fecha_fin_exp)// si sucede esto esta fuera de rango en fechas
	{
	  	?>
	     	<script language="javascript">
	           alert('La fecha fin no puede ser mayor que la fecha de fin del											    	 expediente.');
			</script>
	    <?
	  return false; 
	}
 return true;
}

function calcularEdad($fecha_nacimiento){
	$trozos=explode("-",$fecha_nacimiento,3);
	$ano = $trozos[0];
	$mes = $trozos[1];
	$dia = $trozos[2];
	
	$ano_actual = date("Y");
	$mes_actual = date("m");
	$dia_actual = date("d");
	/*Si el mes es el mismo al actual y el dia es inferior todavia no ha cumplido 
	años `por lo que le restamos un año */
	if(($mes = $mes_actual)&& ($dia < $dia_actual)){
		$ano_actual = $ano_actual -1;
	}
	/*si el mes del nacimiento es mayor que el mes actual todavia no ha cumplido los años,
		restamos un año.*/
	if($mes > $mes_actual){
		$ano_actual =$ano_actual -1;
	}
	$edad = ($ano_actual - $ano) + 1;
	return $edad;
}


?>