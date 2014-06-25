<?php

function pasarPrimeraLetraMay($cadena){
	/*Funcion que pone la primera letra en mayusculas de una cadena.*/
	$aux =$cadena;
	$aux1 = substr($aux,0,1);//cojo la primera letra
	$resto = substr($aux,1,strlen($aux));//cojo el resto de la palabra
	$resto = strtolower($resto);//paso el resto a minusculas
	$aux1= strtoupper($aux1);//pongo la primera letra may
	$nombre = $aux1.$resto;//concateno la Mayuscula con el resto.
	return $nombre;
}

/*Esta funcion pasa a mayusculas todas las letras de una cadena*/
function pasarMay($cadena){
	$aux =$cadena;
	$aux = strtoupper($aux);
	return $aux;
}

function formatearFecha($fecha){
	
	return $fechaformateada;
}
?>