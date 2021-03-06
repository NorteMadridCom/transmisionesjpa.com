<?php
define('PATH','http://'.$_SERVER['SERVER_NAME']. '/');
require_once 'includes/conexion.php';
require_once 'includes/class.phpmailer.php';
require_once 'includes/class.smtp.php';
require_once 'includes/mysql.php';

include 'seo.php';
$seo = new Seo();
$titulo=$seo->titulo();
$descripcion=$seo->descripcion();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<title><?php echo $titulo; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/estilo.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/menu_productos.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/descripcion.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/contacto.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>css/footer.css" />
		<meta name="Robots" content="All">
		<meta http-equiv="content-language" content="es">
		<meta name="keywords" content="reductores, reductor, motores, motor, guias lineales, guia lineal, cadenas, cadena, reductores de precision, reductor de precision, acoplaminetos, acoplamiento, correas, correa, pi�ones, pi�on, bujes de fijacion, buje de fijacion, engranajes, engranaje, cremalleras, cremallera, husillos, husillo, gatos mecanicos, gato mecanico, convertidores frecuencia, convertidor frecuencia, actuadores lineales, actuador lineal, limitadores de par, limitador de par, varmec, tramec, reggiana reduttori, apex dynamic, nabtesco, trasmil, graessner, hiwin, mecvel, vmh herion, jakob, hydro-mec, thomson, zimm, eltra"/>
		<meta name="description" content="<?php echo $descripcion; ?>"/>

		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-21123743-3']);
			_gaq.push(['_setDomainName', 'none']);
			_gaq.push(['_setAllowLinker', true]);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

		<!--- ORBIT --->
		<!-- Attach our CSS-->
		<link rel="stylesheet" href="<?php echo PATH; ?>orbit/css/orbit-1.2.3.css">
		<!--<link rel="stylesheet" href="orbit/css/orbit-1.3.0.css">-->

		<!-- Attach necessary JS -->
		<script type="text/javascript" src="<?php echo PATH; ?>orbit/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="<?php echo PATH; ?>orbit/js/jquery.orbit-1.3.0.js"></script>
		<link rel="stylesheet" href="<?php echo PATH; ?>orbit/css/mobile.css">

		<!--[if IE]>
		<style type="text/css">
		.timer { display: none !important; }
		div.caption { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);zoom: 1; }
		</style>
		<![endif]-->

		<!-- Run the plugin -->
		<script type="text/javascript">
			$(window).load(function() {
				$('#orbit').orbit({
					animation : 'fade', // fade, horizontal-slide, vertical-slide, horizontal-push
					fluid : true,
					animationSpeed : 800, // how fast animtions are
					timer : true, // true or false to have the timer
					advanceSpeed : 4000, // if timer is enabled, time between transitions
					pauseOnHover : false, // if you hover pauses the slider
					startClockOnMouseOut : false, // if clock should start on MouseOut
					startClockOnMouseOutAfter : 1000, // how long after MouseOut should the timer start again
					directionalNav : true, // manual advancing directional navs
					captions : true, // do you want captions?
					captionAnimation : 'fade', // fade, slideOpen, none
					captionAnimationSpeed : 800, // if so how quickly should they animate in
					bullets : true, // true or false to activate the bullet navigation
					bulletThumbs : false, // thumbnails for the bullets
					bulletThumbLocation : '', // location from this file where thumbs will be
					afterSlideChange : function() {
					} // empty function
				});

			});

		</script>

	</head>

	<body>
		<header>
			<div style="background-color: #fff; height: 120px;">
				<div style="width: 100%; min-width: 320px; max-width: 1000px; margin: 0 auto;">

					<div id="left">

						<a href="<?php echo PATH; ?>index.php" class="logo"><img src="<?php echo PATH; ?>images/logo.png" /></a>
					</div>

					<div id="right" style="background-color: #fff;">

						<div id="buscador">
							<form enctype="multipart/formdata" method="post" action="/seccion/buscar/">
								<input class="buscar" type="text" placeholder="Buscar..." required="" value="" name="buscar_txt">
								</input>
								<div id="lupa">
									<button class="lupa" type="submit"></button>
								</div>
							</form>

						</div>

						<div id="menu_cabecera">
							<a href="/seccion/empresa/" class="titulos_menu_cabecera">Empresa</a>
							<a href="/seccion/productos/" class="titulos_menu_cabecera">Productos</a>
							<a href="/seccion/representadas/" class="titulos_menu_cabecera">Representadas</a>
							<a href="/seccion/contacto/" class="titulos_menu_cabecera">Contacto</a>
						</div>

					</div>

				</div>
			</div>

		</header>

		<div style="clear: both;"></div>
		<div style="background-color: #fff;">
			<?php
			if (!$_GET['seccion'] || $_GET['seccion'] == 'empresa')
				require 'orbit.php';
 			?>
		</div>
		<div id="gris">

			<?php

			$cadena_links = PATH;
			$cadena_navegacion = '<a href="' . $cadena_links . '" class="navegador">Transmisiones JPA</a>';
			$comodin = "<div id='flecha'> <img src='".PATH."images/flecha.png'></div>";

			if ($_GET['seccion']) {
				$cadena_links .= 'seccion/' . urlencode($_GET['seccion']) .'/';
				$cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['seccion']) . '</a>';

				if ($_GET['familia']) {
					$cadena_links .= urlencode( $_GET['familia'] ) .'/';
					$cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['familia']) . '</a>';
					
					if (isset($_GET['tipo'])) {
						$cadena_links .= urlencode( $_GET['tipo']).'/' ;
						if($_GET['tipo']) $cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['tipo']).'</a>';

						if (isset($_GET['clase'])) {
							$cadena_links .= urlencode( $_GET['clase']) . "/" ;
							if($_GET['clase']) $cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['clase']) . '</a>';
						
							if($_GET['catalogo']) {
								$cadena_links .= urlencode( $_GET['catalogo'] ) ."/" ;
								$cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['catalogo']).'</a>';
							}
						}
					}
				} elseif ($_GET['fabricante']) {
					$cadena_links .= 'fabricante/' . urlencode( $_GET['fabricante'] ) . "/" ;
					$cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['fabricante']) . '</a>';
					if($_GET['catalogo']) {
						$cadena_links .= urlencode( $_GET['catalogo'] ) . "/" ;
						$cadena_navegacion .= $comodin . '<a href="' . $cadena_links . '"  class="navegador">' . ucwords($_GET['catalogo']).'</a>';
					}
				}
			}

			echo '

<div style="border-bottom: 1px solid #eee; "></div>

<div id="gris">
<div style=" margin-top: 15px;">
<div id="contenedor_central">
<div id="navegador">' . $cadena_navegacion . '</div>
<div style="clear: both;"></div>
</div>
</div>

<div id="contenedor_central">';

			if ($_GET['seccion'] == 'representadas') {
				require 'representadas.php';
			} elseif ($_GET['seccion'] == 'productos') {
				require 'catalogo.php';
			} elseif ($_GET['seccion'] == 'fabricantes') {
				require 'catalogo.php';
			} elseif ($_GET['seccion'] == 'contacto') {
				require 'contacto.php';
			} elseif ($_GET['seccion'] == 'buscar') {
				require 'buscador.php';
			} else {
				require 'empresa.php';
			}
		?>
			</div>

			</div>
		</div>

		<footer>
			<div style="width: 100%; min-width: 320px; max-width: 1000px; margin: 0 auto;">
				<p style="float: left;   display: block;">
					<div id="footer">
						C/ Montevideo,3 - Nave 6 Pol.Ind.Camporroso | 28806 Alcal&aacute de Henares (Madrid)
						<br>
						<br>
						Telf: 91 001 59 72 Fax: 91 001 54 08  | <a href="mailto:jpa@transmisionesjpa.com" class="linknortemadrid" style="font-size: 14px;">jpa@transmisionesjpa.com</a>
					</div>
					<div style="border-bottom: 1px solid #B08D00; padding-top: 35px; opacity: 0.5;"></div>

					<div id="prg_norte_madrid">
						Programado y dise&ntildeado por <a class="linknortemadrid" href="http://www.nortemadrid.com" target="_blank">NorteMadrid.Com</a>
					</div>
				</p>
		</footer>

	</body>

</html>

</body>

</html>
