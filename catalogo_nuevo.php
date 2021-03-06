<?php

class Catalogo
{
	
	/*
	 * Mostramos el catálogo dentro de sus cajas
	 * necesitamos analizar la url para saber donde estamos
	 * /productos/familias/tipo/clases/catálogo 
	 * hay que hacer el htaccess, pero a la web le da igual.
	 */
	
	private $_cata=object;
	private $_sql;
	private $_url;
	
	public function __construct()
	{
		$this->_cata=new Mysql;
	}

	private function _tabla($tabla)
	{
		$tablas=array('familias','tipos','clases','catalogos');
		if($tabla=="fabricantes") $tablas=array("fabrincantes","catalogos");
		return $tablas[array_search($tabla, $tablas)+1];
	}
	
	public function ficha($nombre,$tabla='familias')
	{
		$nombre=urldecode($nombre);
		$campo=substr($tabla, 0, -1);
		$sql="SELECT *, id$campo as id FROM $tabla f WHERE $campo='$nombre' AND eliminado=0;";
		$this->_cata->ejecutar_consulta($sql);
		$imagen=$this->_cata->regiistros[0]->imagen;
		if(!$imagen) $imagen = "imagen por defecto";
		//ponemos la ficha si hay descripcion, entendemos que el producto existe y es unico
		if ($this->_cata->registros[0]->descripcion) require 'ficha.php';
		if($this->_tabla($tabla)) $this->menu($this->_tabla($tabla), "AND id$campo={$this->_cata->registros[0]->id}");
	}
	
	public function menu($tabla, $filtro=false)
	{
		/*
		 * Ahora es cuando tengo que mirar si es 0 y solo tenemos un resultado para pasar el siguiente o llamarse a sí mismo
		 */
		if (!$this->_url) $this->_url=$_SERVER['REQUEST_URI'];
		$menu=substr($tabla, 0,-1);
		$id='id'.$menu;
		$sql="SELECT *, $menu as cero, $id as id FROM $tabla WHERE eliminado=0 $filtro ;";
		$this->_cata->ejecutar_consulta($sql);
		if($this->_cata->registros[0]->cero=="0") {
			//tiene que llamarse a si mismo pero con el otro nomrbe del siquiente	
			$filtro="AND $id={$this->_cata->registros[0]->id}";
			$this->_url .= "0/";
			if($this->_tabla($tabla)) $this->menu($this->_tabla($tabla),$filtro);
		} elseif($this->_cata->numero_registros>0) { // o es cero o es una opción valida.
			foreach ($this->_cata->registros as $val) {
				require 'caja.php';
			}
			echo '<div style="clear: both;"></div>';
		} else echo "Obras";
	}
	
}