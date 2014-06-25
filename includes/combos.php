<?php
/*
function cargaComboAlumno($combo){
	$result = mysql_query("SELECT idalumno,nombre FROM alumnos WHERE eliminado =0 
		ORDER BY primer_apellido ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""</option>';
	while($row = mysql_fetch_array($result)){
    	echo '<option value= "'.$row["idalumno"].'">'.$row["nombre"].'</option>';
	}; 
	echo '</select>';
}
	
function cargaComboPostales($combo){
	$result = mysql_query("SELECT idpostal,codigo_postal FROM codigos_postales 
		ORDER BY codigo_postal ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
    	echo '<option value= "'.$row["idpostal"].'">'.$row["codigo_postal"].'</option>';
	}; 
	echo '</select>';
}

function cargaComboPostalesId($combo,$idpostal){
	$result = mysql_query("SELECT idpostal,codigo_postal FROM codigos_postales 
		ORDER BY codigo_postal ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		if($row["idpostal"]==$idpostal){
		   echo '<option value= "'.$row["idpostal"].'" selected="selected">'.$row["codigo_postal"].'</option>';
		}else{
			echo '<option value= "'.$row["idpostal"].'">'.$row["codigo_postal"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboLocalidades($combo){
	$result = mysql_query("SELECT idlocalidad,localidad FROM localidades
		ORDER BY idlocalidad ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
    	echo '<option value= "'.$row["idlocalidad"].'">'.$row["localidad"].'</option>';
	}; 
	echo '</select>';
}

function cargaComboLocalidadesId($combo,$idlocalidad){
	$result = mysql_query("SELECT idlocalidad,localidad FROM localidades
		ORDER BY idlocalidad ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>'; 
	while($row = mysql_fetch_array($result)){
   		if($row["idlocalidad"]==$idlocalidad){
		   echo '<option value= "'.$row["idlocalidad"].'" selected="selected">'.$row["localidad"].'</option>';
		}else{
			echo '<option value= "'.$row["idlocalidad"].'">'.$row["localidad"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboProvincias($combo){
	$result = mysql_query("SELECT idprovincia,provincia FROM provincias
			WHERE eliminado =0 ORDER BY provincia ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
    	echo '<option value= "'.$row["idprovincia"].'">'.$row["provincia"].'</option>';
	}; 
	echo '</select>';
}

function cargaComboProvinciasId($combo,$idprovincia){
	$result = mysql_query("SELECT idprovincia,provincia FROM provincias
			WHERE eliminado =0 ORDER BY provincia ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	//echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		if($row["idprovincia"]==$idprovincia){
		   echo '<option value= "'.$row["idprovincia"].'" selected>'.$row["provincia"].'</option>';
		}else{
			echo '<option value= "'.$row["idprovincia"].'">'.$row["provincia"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboComunidades($combo){
	$result = mysql_query("SELECT idcomunidad,comunidad FROM comunidades
		WHERE eliminado =0 ORDER BY comunidad ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
    	echo '<option value= "'.$row["idcomunidad"].'">'.$row["comunidad"].'</option>';
	}; 
	echo '</select>';
}

function cargaComboComunidadesId($combo,$idcomunidad){
	$result = mysql_query("SELECT idcomunidad,comunidad FROM comunidades
			WHERE eliminado =0 ORDER BY comunidad ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
		if($row["idcomunidad"]==$idcomunidad){
			echo '<option value= "'.$row["idcomunidad"].'" selected="selected">'.$row["comunidad"].'</option>';
		}else{
			echo '<option value= "'.$row["idcomunidad"].'">'.$row["comunidad"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboZonas($combo){
	$result = mysql_query("SELECT idzona,zona FROM zonas 
				WHERE eliminado =0 ORDER BY zona ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
    	echo '<option value= "'.$row["idzona"].'">'.$row["zona"].'</option>';
	};
	echo '</select>';
}

function cargaComboZonasId($combo,$idzona){
	$result = mysql_query("SELECT idzona,zona FROM zonas
			WHERE eliminado =0 ORDER BY zona ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		if($row["idzona"]==$idzona){
		   echo '<option value= "'.$row["idzona"].'" selected="selected">'.$row["zona"].'</option>';
		}else{
			echo '<option value= "'.$row["idzona"].'">'.$row["zona"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboExpedientes($combo){
	$result = mysql_query("SELECT idexpediente,referencia_expediente FROM expedientes
		ORDER BY referencia_expediente ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		echo '<option value= "'.$row["idexpediente"].'">'.$row["referencia_expediente"].'</option>';
	}; 
	echo '</select>';
}

function cargaComboExpedientesId($combo,$idexpediente){
	$result = mysql_query("SELECT idexpediente,referencia_expediente FROM expedientes 
		ORDER BY referencia_expediente ASC;");	
	//Llenas el combo
	echo '<select name="'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		if($row["idexpediente"]==$idexpediente){
			echo '<option value= "'.$row["idexpediente"].'" selected="selected">'.$row["referencia_expediente"].'</option>';
		}else{
			echo '<option value= "'.$row["idexpediente"].'">'.$row["referencia_expediente"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboAños($combo){
	$result = mysql_query("SELECT idano,ano FROM anos 
		WHERE eliminado =0 ORDER BY ano ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
		if ($_POST['comboanos']==$row['idano']){
			$selected="selected";
		}else{
			$selected="";
		}
		echo '<option value= "'.$row["idano"].''.$selected.'">'.$row["ano"].'</option>';
	};
	echo '</select>';
}

function cargaComboAñosId($combo,$idano){
	$result = mysql_query("SELECT idano,ano FROM anos 
		ORDER BY ano ASC;");	
	//Llenas el combo
	echo '<select name="'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		if($row["idano"]==$idano){
   			$selected="selected";
			echo '<option value= "'.$row["idano"].'" selected="selected">'.$row["ano"].'</option>';
		}else{
			echo '<option value= "'.$row["idano"].'">'.$row["ano"].'</option>';
		}
	}; 
	echo '</select>';
}

function cargaComboSedes($combo){
	$result = mysql_query("SELECT idsede,sede FROM sedes 
		WHERE eliminado =0 ORDER BY sede ASC;");	
	//Llenas el combo
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		echo '<option value= "'.$row["idsede"].'">'.$row["sede"].'</option>';
	};
	echo '</select>';
}

function cargaComboSedeId($combo,$idsede){
	$result = mysql_query("SELECT idsede,sede FROM sedes 
		ORDER BY sede ASC;");	
	//Llenas el combo
	echo '<select name="'.$combo.'">';
	echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		if($row["idsede"]==$idsede){
			echo '<option value= "'.$row["idsede"].'" selected="selected">'.$row["sede"].'</option>';
		}else{
			echo '<option value= "'.$row["idsede"].'">'.$row["sede"].'</option>';
		}
	}; 
	echo '</select>';
}*/

function cargaComboTiposZona($combo){
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	echo '<option value= "Convergencia">Convergencia</option>';
	echo '<option value= "No Convergencia">No Convergencia</option>';
	echo '<option value= "Resto">Resto</option>';
	echo '</select>';
}

function cargaComboTiposZonaId($combo,$idtipo){
	echo '<select name= "'.$combo.'">';
	echo '<option value=""></option>';
	$select="selected";
	if ($idtipo == 'Convergencia'){
		echo '<option value= "Convergencia" '.$select.'>Convergencia</option>';
		echo '<option value= "No Convergencia">No Convergencia</option>';	
	}elseif($idtipo == 'No Convergencia'){
		echo '<option value= "Convergencia">Convergencia</option>';
		echo '<option value= "No Convergencia" '.$select.'>No Convergencia</option>';
		echo '<option value= "Resto">Resto</option>';	
	}else{
		echo '<option value= "Convergencia">Convergencia</option>';
		echo '<option value= "No Convergencia">No Convergencia</option>';
		echo '<option value= "Resto" '.$select.'>Resto</option>';
	}	
	echo '</select>';
}

function cargarLocalidadProvincia($idprovincia){
	$sql_localidades = mysql_query("SELECT * FROM localidades WHERE idprovincia='$idprovincia'
					ORDER BY localidad;");
	//Llenas el combo
	echo '<select name="localidades">';
	//echo '<option value=""></option>';
	while($row = mysql_fetch_array($result)){
   		echo '<option value= "'.$row["idlocalidad"].'" >'.$row["localidad"].'</option>';
	}
	echo '</select>';
	
}

?>