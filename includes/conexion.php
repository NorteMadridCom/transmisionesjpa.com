<?php


$servidor = 'localhost';
$usuario = 'root';
$clave = 'root';
$bd = 'trasmisionesjpa';

/*
$servidor = 'localhost';
$usuario = 'jpa2';
$clave = '#Jpa2@123456';
$bd = 'transmisionesjpa2';
*/
$result = mysql_connect($servidor, $usuario, $clave);
//echo $result ;

mysql_select_db($bd,$result) or die('Error al conectar a la bbdd '. $bd);


?>
