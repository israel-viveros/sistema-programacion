<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
/*
	# Developer: Israel Viveros
*/

include("config.php");
include("functions.php");

$mysqli = new mysqli(URL_DATABASE, USER_DATABASE, PASSWORD_DATABASE, TABLE_DATABASE);
if ($mysqli->connect_errno) {
    //echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    echo 'Fallo la conexion con la base de datos, solo se generaran los JSON';
}

$year=substr(date('Y'),2,2);
$month=date('m');
$day=date('d');

$channelArray[0]="canal2";
$channelArray[1]="canal5";
$channelArray[2]="canal9";
$channelArray[3]="canalftv";

for($i=0;$i<7;$i++){
		if($i>0)
			$day = ((int)$day+1);
		if((int)$day>31){
			$month=$month+1;
			if($month>12){
				$month="01";
				$year=$year+1;
			}	
			$day = $day-31;
		}
		if(strlen($day)<2 && $day<10){
			$day="0".$day;
		}
	
	$currentDate[$i]=$year.$month.$day;
}


for($h=0;$h<sizeof($currentDate);$h++){
	
	
	for($z=0;$z<sizeof($channelArray);$z++){
	$posibleFile=URL_FEED_ORIGIN.$channelArray[$z]."/programacion_".$currentDate[$h].".js";	
		if(@fopen($posibleFile,"r")){			
			$diferencialContent=leer_contenido_completo($posibleFile);
			$diferencialContent=htmlentities($diferencialContent,ENT_NOQUOTES,'iso-8859-1');
			for($j=0;$j<10;$j++){
				$diferencialContent=str_replace("programaciontv$j=",'',$diferencialContent);
			}
			
			
			@$validationSpace=dir(PROD_FOLDER."/".$channelArray[$z]);
			if($validationSpace==false){
				mkdir(PROD_FOLDER."/".$channelArray[$z],0775);
			}
			
			
			$existedFile=URL_FEED_OUTPUT.$channelArray[$z]."/".$currentDate[$h].".js";
			$verifica = get_headers($existedFile);
			if(!strpos($verifica[0], "404")){
				echo "el archivo ya existe:  ".URL_FEED_OUTPUT.$channelArray[$z]."/".$currentDate[$h].".js<br>";
			}else{
				$finalProductionFile=generate_production_JS($diferencialContent,$channelArray[$z],$currentDate[$h]);
				echo "creando archivo: ".URL_FEED_OUTPUT.$channelArray[$z]."/".$currentDate[$h].".js<br>";


				// INSERTS				
				$JsonContent = json_decode($diferencialContent, true);


				// insert nombre del canal
				

				//ID del CANAL
				$IDCANAL= getID($mysqli);
				$channelName = strtolower($JsonContent['PROGRAMACION']['CANAL']['title']);	

				$channelexist = $mysqli->query("SELECT id_canal FROM canal WHERE nombre ='".$channelName."'");			 
				
				if($channelexist->num_rows==0){
					$queryCANAL = "INSERT INTO canal VALUES ('".$IDCANAL."', '".$channelName."', '".$JsonContent['PROGRAMACION']['CANAL']['logo']."')";
						if ($mysqli->query($queryCANAL)) {
							echo "<h3>Canal Agregado</h3>".strtolower($JsonContent['PROGRAMACION']['CANAL']['title']);
						}else{
							echo "<h3>Canal NO Agregado</h3>".strtolower($JsonContent['PROGRAMACION']['CANAL']['title']);
						}

				}else{
					echo "<br>ya no agrego el canal<BR>";
				}


				// FECHA
				$IDFecha = getID($mysqli);
				$fechatmp = $JsonContent['PROGRAMACION']['FECHA'];	

				$dateexist = $mysqli->query("SELECT id_fecha FROM fecha WHERE fecha ='".$fechatmp."'");			 
				
				if($dateexist->num_rows==0){
					$queryDate = "INSERT INTO fecha VALUES ('".$IDFecha."', '".$fechatmp."')";
						if ($mysqli->query($queryDate)) {
							echo "<h3>Fecha Agregada</h3>".$fechatmp;
						}else{
							echo "<h3>Fecha no Agregada</h3>".$fechatmp;
						}

				}else{
					echo "<br>ya no agrego la fecha<br>";
				}
				 

				
				

				


/*
	
				echo "la fecha del json es: ". $JsonContent['PROGRAMACION']['FECHA'];
				


				foreach ($JsonContent['PROGRAMACION']['CANAL']['SHOWS'] as $key => $bodyShow) {
					
					//programa
					echo "<br>_________PROGRAMA__________<br>";
					echo $bodyShow['title'];
					echo "<br>";
					echo $bodyShow['descripcion'];
					echo "<br>____________________<br>";

					echo "<br>_________CONTENIDO__________<br>";
					echo $bodyShow['horario'];
					echo "<br>";
					echo (int)$bodyShow['duration'];
					echo "<br>";
					echo (int)$bodyShow['timestamp'];
					echo "<br>";
					
				}
*/
				//END INSERTS




			}
			
			
			
		}
	}
}
			


?>