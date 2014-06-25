<?php
function conocer_ext($documento)
{
	
	$tamano=strlen($documento);
	$documento_invertida=strrev($documento);
	$ext_invertida=substr($documento_invertida,0,3);
	$ext=strrev($ext_invertida);
	if ($ext== "gif" || $ext== "jpeg" || $ext== "png" || $ext== "jpg")
	{
		$imagen="img_icono.png";
	}
	elseif ($ext=="pdf")
	{
		$imagen="pdf_icono.gif";
	}
	elseif ($ext=="rar")
	{
		$imagen="rar_icono.png";
	}
	else
	{
		$imagen="txt_icono.png";
	}
	return ($imagen);
}
?>