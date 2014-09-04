<!-- hay que poner las URLS amigables, de momento lo pospongo -->
<a href="<?php echo $this->_url .urlencode(strtolower($val->cero)). "/"; ?>" class="cuadros">
	<div id="cuadros">
		<div id="esquina"></div>
		<div id="img"><img src="<?php echo PATH; ?>images/catalogo/<?php echo $val->imagen; ?>" class="img"/></div>
		<div id="titulo"><?php echo $val->cero; ?></div>
	</div>
</a>