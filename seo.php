<?php

class Seo
{
	
	public function titulo()
	{
		$titulo=array("Transmisiones Electromecánicas Madrid JPA, S.L.");
		if ($_GET['fabricante']) $titulo[]=urldecode($_GET['fabricante']);
		if ($_GET['familia']) $titulo[]=urldecode($_GET['familia']);
		if ($_GET['tipo']) $titulo[]=urldecode($_GET['tipo']);
		if ($_GET['clase']) $titulo[]=urldecode($_GET['clase']);
		if ($_GET['catalogo']) $titulo[]=urldecode($_GET['catalogo']); 
		krsort($titulo);
		return ucfirst(implode(" - ", $titulo)); 
	}
	
	public function descripcion()
	{
		$descripcion="Transmisiones Electromecánicas JPA es una empresa de nueva factoría 
		pero que cuenta con profesionales con más de 14 de experiencia en el sector. 
		Somos especialistas tanto en el matenimiento de empresas como en nuevas instalaciones, 
		siendo nuestro objetivo la calidad y rapidez de servicio. Queremos alcanzar el máximo nivel de competitividad, 
		servicio, técnica, calidad y rentabilidad para nuestros clientes, 
		por lo que ofrecemos una extensa gama de productos mediante la selección de los mejores fabricantes.";
		
		if ($_GET['catalogo']) $campo="catalogo";
		elseif ($_GET['clase']) $campo="clase";
		elseif ($_GET['tipo']) $campo="tipo";
		elseif ($_GET['familia']) $campo="familia";
		elseif ($_GET['fabricante']) $campo="fabricante"; 
		$val=urldecode($_GET[$campo]);
		
		if($campo) {
			$sql = "SELECT descripcion FROM {$campo}s WHERE $campo='$val';";
			$des=new Mysql;
			$des->ejecutar_consulta($sql);
			if ($des->numero_registros==1) $descripcion=$des->registros[0]->descripcion;
		}
		
		return $descripcion;
	}
}
