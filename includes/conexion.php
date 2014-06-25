<?php
//$servidor = proyectoservido;
$servidor = 'localhost';
$usuario = 'root';
$clave = 'root';
$bd = 'trasmisionesjpa';

$result = mysql_connect($servidor, $usuario, $clave);
//echo $result ;

mysql_select_db($bd,$result) or die('Error al conectar a la bbdd '. $bd);


?>
