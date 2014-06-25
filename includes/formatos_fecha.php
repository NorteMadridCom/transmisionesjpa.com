<?php

function formato_fecha ($dia)
{
	if ($dia!=NULL)//para visualizar
	{
		if(strlen($dia==8))
		{
			$dia1=substr($dia,6,2);
			$mes1=substr($dia,4,2);
			$ano1=substr($dia,0,4);
			$dia="$ano1-$mes1-$dia1";
		}
		$dia=preg_replace( "/\//", "-", $dia);
		$fecha_formato=explode ("-",$dia);
		return (date("d-m-Y",mktime(0,0,0,$fecha_formato[1],$fecha_formato[2],$fecha_formato[0])));
	}		
}
function formato_fecha2 ($dia)//para meter en SQL
{
	if ($dia!=NULL)
	{
		if(strlen($dia==8))
		{
			$dia1=substr($dia,0,2);
			$mes1=substr($dia,2,2);
			$ano1=substr($dia,4,4);
			$dia="$dia1-$mes1-$ano1";
		}
		$dia=preg_replace( "/\//", "-", $dia);
		$fecha_formato=explode ("-",$dia);
		return (date("Y-m-d",mktime(0,0,0,$fecha_formato[1],$fecha_formato[0],$fecha_formato[2])));
	}		
}

function formato_fecha3 ($dia)//para meter en SQL
{
	if ($dia!=NULL)
	{
		$fecha_formato=explode ("/",$dia);
		return (date("Y-m-d",mktime(0,0,0,$fecha_formato[1],$fecha_formato[0],$fecha_formato[2])));
	}		
}
function fecha_unix($dia)
{
	if ($dia!=NULL)
	{
		if(strlen($dia==8))
		{
			$dia1=substr($dia,0,2);
			$mes1=substr($dia,2,2);
			$ano1=substr($dia,4,4);
			$dia="$dia1-$mes1-$ano1";
		}
		$dia=preg_replace( "/\//", "-", $dia);
		$fecha_formato=explode ("-",$dia);
		return mktime(0,0,0,$fecha_formato[1],$fecha_formato[0],$fecha_formato[2]);
	}		
}

function hora_unix($hora)
{
	if ($hora!=NULL)
	{
		$hora_formato=explode (":",$hora);
        return mktime($hora_formato[0],$hora_formato[1],0,0,0,0);	
	}		
}

function formato_hora ($hora)
{
	$hora_formato=explode (":",$hora);
	return (date("H:i",mktime($hora_formato[0],$hora_formato[1],0,0,0,0)));		
}

function comparar_fechas($a,$b)  
{  
   /*  1 si la fecha a es mayor que la fecha b
     0 si son iguales
    -1 si la fecha a es menor que la fecha b
   */
    
    $a_v=explode("-",$a);  
    $anyo_a = $a_v[0];  
    $mes_a = $a_v[1];  
    $dia_a = $a_v[2];  

    $b_v=explode("-",$b);  
    $anyo_b = $b_v[0];  
    $mes_b = $b_v[1];  
    $dia_b = $b_v[2];  

    if($anyo_a > $anyo_b)  
        return 1;  
    else  
    {  
        if($anyo_a < $anyo_b)  
            return -1;  
        else  
        {  
            if($mes_a > $mes_b)  
                return 1;  
            else  
            {  
                if($mes_a < $mes_b)  
                    return -1;  
                else  
                {  
                    if($dia_a > $dia_b)  
                        return 1;  
                    else  
                    {  
                        if($dia_a < $dia_b)  
                            return -1;  
                        else  
                            return 0;  
                    }  
                }  
            }  
        }  
    }  
}  


?>