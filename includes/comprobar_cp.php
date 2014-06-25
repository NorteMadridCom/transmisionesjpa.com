<?php
           
function comprobar_cps($cp,$localidad)
{
	$alta=false;
	$existe=false;

	if (!ereg("[0-9]{5}",$cp))
	{
		//return $correcto['cp'] = false;
		return 'cp';
	}
	else//el codigo postal es correcto
	{
	
		$sql_cp="SELECT * FROM cps WHERE cp='$cp';";
		$consulta_cp=mysql_query($sql_cp) or die("<p>Error al consultas los cp's".mysql_error()."La consulta es: $sql_cp</p>");
		$num_localidades=mysql_num_rows($consulta_cp);
		
		if($num_localidades==0)//no exise el cp
		{
			if(!$localidad)
			{
				//return $correcto['localidad'] = false;
				return 'localidad';
			}
			else
			{
				$alta=true;
			}
		}
		elseif($num_localidades==1)
		{
			//una localidad un cp, 
			$registros_cp=mysql_fetch_array($consulta_cp);
			$localidad_sql=$registros_cp['localidad'];
			if($localidad && (strtoupper($localidad)!=$registros_cp['localidad']))
			{				
				$alta=true;
			}
			else
			{
				$existe=true;
			}
		}
		else
		{
			//hay mas de una localidad con el mismo cp, tiene que especificar la localidad si no la ha puesto
			if($localidad)
			{
				//miro a ver si coincide
				$sql_localidad="SELECT * FROM cps WHERE cp='$cp' AND localidad='$localidad';";
				$consulta_localidad=mysql_query($sql_localidad) or die("<p>Error las localidades de los cp's".mysql_error()."La consulta es: $sql_localidad</p>");
				if(!mysql_num_rows($consulta_localidad))
				{
					$alta=true;
				}
				else
				{
					$existe=true;
				}
			}
			else
			{
				//return $correcto['localidad']= false;
				return 'localidad';
			}
				
		}
	}			
	
	$idprovincia=substr($cp, 0, 2);
	$localidad=strtoupper($localidad);
		
	if($alta===true)
	{
		$sql_alta_cp="INSERT INTO cps SET cp='$cp', localidad='$localidad', idprovincia='$idprovincia';";
		$consulta_alta_cp=mysql_query($sql_alta_cp) or die ("<p>Fallo al insertar el nuevo cp:".mysql_error().". La consulta es: $sql_alta_cp</p>");
		$idcp=mysql_insert_id();
		return $idcp;
	}
	elseif($existe===true)
	{
		if($num_localidades=1)
		{
			$sql_buscar_cp="SELECT idcp FROM cps WHERE cp='$cp';";
		}
		else
		{
			$sql_buscar_cp="SELECT idcp FROM cps WHERE cp='$cp' AND localidad='$localidad';";
		}
		$consulta_buscar_cp=mysql_query($sql_buscar_cp) or die ("<p>Fallo al consultar el cp:".mysql_error().". La consulta es: $sql_buscar_cp</p>");
		$registro_buscar_cp=mysql_fetch_array($consulta_buscar_cp);
		$idcp=$registro_buscar_cp['idcp'];
		return $idcp; 
	}
	
}

?>