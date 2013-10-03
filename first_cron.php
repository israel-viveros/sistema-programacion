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
			}
			
			
			
		}
	}
}
			


?>