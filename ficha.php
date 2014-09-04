
	
	<h1><?php echo $this->_cata->registros[0]->$campo; ?></h1>
	
	<div id="descripcion">
			
		<div id="izquierda">
			<div id="img_descripcion">
				<img src="<?php echo PATH; ?>images/catalogo/<?php echo $imagen; ?>" alt="<?php echo $this->_cata->registros[0]->$campo; ?>" width="450" />
			</div>
		</div>

		<p class="descripcion">
			<?php echo $this->_cata->registros[0]->descripcion; ?>
		</p>
		
		<div id="derecha">	
			<?php if($this->_cata->registros[0]->planos) { ?><a class="link" href="<?php echo $this->_cata->registros[0]->planos; ?>">Planos 2D/3D &raquo</a><?php } ?>
			<?php if($this->_cata->registros[0]->documento) { ?><a class="pdf" href="<?php echo $this->_cata->registros[0]->documento; ?>">Descargar PDF &raquo</a><?php } ?>
		</div>
		
		<div style="clear: both;"></div>
		
	</div>
	
	<!-- Ponemos las cajas si procede de lso subs -->
		
	
