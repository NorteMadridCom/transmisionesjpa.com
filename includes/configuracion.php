<?php

//require('conexion.php');

$sql_conf="SELECT * FROM configuraciones;";
$consulta_conf=mysql_query($sql_conf) or die("Error al consultar la configuración: ".mysql_error());
while($resultado_conf=mysql_fetch_array($consulta_conf))
{
	$config[$resultado_conf['variable']]=$resultado_conf['valor'];
}

?>