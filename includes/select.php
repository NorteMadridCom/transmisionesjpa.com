<?php
function select($tabla,$orden,$nombre_select,$actual,$predeterminado,$campo_id,$matriz_campos,$habilitado=false)
{
	//echo 'Actual'.$actual.' CampoId'.$campo_id;
	if($habilitado){
		$disabled="disabled";
	}else{
		$disabled="";
	}
	echo '<select name="'.$nombre_select.'" '.$disabled.'>';
	if ($actual=='')
	{
		$actual=$predeterminado;
	}
	if($orden!='')
	{
		$orden_sql="ORDER BY $orden";
	}
	
	$sql_select="SELECT * FROM $tabla WHERE eliminado=0 $orden_sql;";
	$resultado_select=mysql_query($sql_select) or die("Error al consultar $tabla: " . mysql_error());
	
	echo '<option value=""></option>';
		
	while($registro_select=mysql_fetch_array($resultado_select, MYSQL_ASSOC))
	{
		$id=$registro_select[$campo_id];
	
		//hay que recorrer la matriz camos para hacer una cadena de caracteres
		$i=0;
		$campo='';
		while($matriz_campos[$i])
		{
			$campo=$campo.' '.$registro_select[$matriz_campos[$i]];
			$i++;
		}
		
		if ($id==$actual)
		{
			$selected="selected";
		}
		else
		{
			$selected="";
		}
		
		echo '<option value="'.$id.'" '.$selected.'>'.$campo.'</option>';
		
	}
	echo '</select>';
	//echo $sql_select;
}
?>