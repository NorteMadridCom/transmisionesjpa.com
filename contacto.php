<?php

function comprobar_formulario($matriz_formulario){
	
    $error = false;
    extract($matriz_formulario);

    foreach ($matriz_formulario as $k => $v)
    {
        $correcto[$k] = true;
    }
    

	if(!preg_match("/^[a-zA-Z0-9_-]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9_.-]*\.[a-zA-Z]{2,5}$/",$mail)){
		$correcto['email']=false;	
	}
	
	if(!$empresa) {
		$correcto['empresa']=false;
	}
	
	if(!$mensaje) {
		$correcto['mensaje']=false;
	}
	
	foreach ($correcto as $k => $v)
    {
        if ($v == false)
        {
            echo '<p class="aviso_contacto">Rellene correctamente el campo '. $k.'</p>';
            $error = true;
        }
    }//fin for
    return $error;
}//fin validar

function formulario_mail($datos) 
{
	echo '		
	</div>
</div>
<br>
	<div id="gris">

<div style="width: 100%; min-width: 320px; max-width: 1000px; margin: 0 auto;  padding-top: 15px; padding-bottom: 50px; ">
	
	<div  style="padding: 20px 0px 40px 0px;">
		<div style="float: left;   display: block; ">
			<form method="post" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
				<table class="contacto">
					
					<tr>
						<td class="contacto">Empresa:</td>
						<td><input class="contacto" type="text" name="empresa" value="'.$datos['empresa'].'" /></td>
					</tr>
					<tr>
						<td class="contacto">Contacto:</td>
						<td><input class="contacto" type="text" name="contacto" value="'.$datos['contacto'].'" /></td>
					</tr>
					<tr>
						<td class="contacto">E-mail:</td>
						<td><input class="contacto" type="text" name="mail" size="30" maxlength="40" value="'.$datos['mail'].'" /></td>
					</tr>
					<tr>
						<td class="contacto">Tel&eacutefono:</td>
						<td><input class="contacto" type="text" name="telefono" size="10" maxlength="9" value="'.$datos['telefono'].'" /></td>
					</tr>
					
					<tr>
						<td colspan="2"><textarea name="mensaje" rows="10" cols="20">'.$datos['mensaje'].'</textarea></td>	
					</tr>
					<tr>
						<td colspan="2"><button class="contacto" type="submit" name="accion" value="enviar">Enviar</button></td>
					</tr>
				</table>	
			</form>
</div>

<div style="float: left;   display: block; ">
	<div id="google_map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3033.29813275412!2d-3.409763000000021!3d40.51290099999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd424a0552261671%3A0xe2d75e0068f0f6af!2sTransmisiones+JPA+S.L.!5e0!3m2!1ses!2sus!4v1399485445772" width="470" height="350" frameborder="0" style="border:0"></iframe></div>
	<div id="contacto">
	<br /></div><div style="clear: both;"></div>

	';
}
?>



	

<?php

if($_POST['accion']=='enviar') 
{
	if(comprobar_formulario($_POST)===false)
	{
		//mandar_email y poner la comprobacion

		 $message = '<table align="center" border="0" bgcolor="#eeeeee" width="600"><tr><td colspan="2" align="center"><b>E-MAIL DESDE SU P�GINA WEB</b></td></tr>';
	    $message .= '<tr><td width="150"><b>Empresa</b></td><td>'; 
	    $message .= $_POST["empresa"];
	    $message .= '</td></tr>';
	    $message .= '<tr><td><b>Nombre del contacto</b></td><td>';
	    $message .= $_POST["contacto"];
	    $message .= '</td></tr>';
	    $message .= '<tr><td><b>Tel�fono</b></td><td>';
	    $message .= $_POST["telefono"];
	    $message .= '</td></tr>';
	    $message .= '<tr><td><b>E-mail</b></td><td>';
	    $message .= $_POST["mail"];
	    $message .= '</td></tr>';
	    $message .= '<tr><td colspan="2"><b>Mensaje</b></td></tr>';
	    $message .= '<tr><td colspan="2">';
	    $message .= $_POST["mensaje"];
	    $message .= '</td></tr>';
	    $message .= '</table>';
	
		//include "includes/class.phpmailer.php";
	
		$mail = new phpmailer();
		$mail->PluginDir = "includes/";
		$mail->Mailer = "smtp";
		$mail->Host = "mail.transmisionesjpa.com";
		$mail->SMTPAuth = true;
		$mail->Username = "jpa@transmisionesjpa.com"; 
		$mail->Password = "TransmisionesJPA2010";
	 	$mail->From = $_POST['mail'];
		$mail->FromName = $_POST["contacto"];
		$mail->Subject = "E-mail enviado desde la p�gina web";
		//$mail->Body = "<p><b>body</b></p>";
		$mail->Body = "$message";
	    //$message;//envio de datos recogidos
		$mail->AltBody = "Mensaje en formato solo texto";//Aunque vaya en formato html, es necesario esta l�nea para el envio
		$mail->Timeout=30;
		//$mail->AddAddress("software@nortemadrid.com");//correo de quien lo va a recibir
	
		$mail->AddAddress("jpa@transmisionesjpa.com");//correo de quien lo va a recibir
		
	    $exito = $mail->Send();
	
	    $intentos=1; 
	    while ((!$exito) && ($intentos < 5)) 
	    {
	    	sleep(5);
	        $exito = $mail->Send();
	        $intentos=$intentos+1;
	    }
	    if(!$exito)
	    {
	        	echo '<p class="aviso_contacto">Problemas enviando correo electr�nico.';
	    		echo "<br />".$mail->ErrorInfo."</p>";	
	    }
	    else
	    {
	        echo '<p class="aviso_contacto">Correo electr�nico enviado correctamente.</p>';
				unset($_POST);
	    }		
		
		
	}
	
}

formulario_mail($_POST);

?>

	</div>

