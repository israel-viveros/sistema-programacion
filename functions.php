<?php
function leer_contenido_completo($url){
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	$texto = curl_exec($ch);
	curl_close($ch); 
  
   return $texto;
}


function generate_production_JS($jsontxt,$canalFolder,$currentDate){
	
	$file=PROD_FOLDER."/".$canalFolder."/".$currentDate.".js";	
	$control = fopen($file,"w+");  
	$control2=fwrite($control,$jsontxt);
	if($control == false || $control2==false){  
	  die("No se ha podido generar el Js:" .$currentDate);  	  
	}
	fclose($control);
	
	return true;
	  
}

/*función que con la hora de incio+duración devuelve la hora de terminación en segundos*/
function finalHourBySeconds($hourStart,$durationSeconds){
	$firstStep=explode(":",$hourStart);
	$hourPrev=(int)($firstStep[0]*3600);
	$minutesPrev=(int)((int)$firstStep[1]*60);
	
	if(isset($firstStep[2]))
		$secondsPrev=(int)$firstStep[2];
	else
		$secondsPrev=0;
	
	$secondsHourStart=(int)($minutesPrev+$hourPrev+$secondsPrev);
	
	$secondsHourEnd=(int)($secondsHourStart+(int)$durationSeconds);
	
	
	
	return $secondsHourEnd;
}

/*Función que convierte segundos a HH:MM*/
function segundos_tiempo($segundos){
	
	//tope para no regresar más de 24HRS
	if($segundos>86400)
		$segundos=86400;
	
	$minutos=$segundos/60;
	$horas=floor($minutos/60);
	$minutos2=$minutos%60;
	$segundos_2=$segundos%60%60%60;
	
	if($minutos2<10)$minutos2='0'.$minutos2;
	if($segundos_2<10)$segundos_2='0'.$segundos_2;
	
	
		$resultado= $horas.':'.$minutos2;
	
	
	return $resultado;
}

/*Función que convierte de HH:MM a segundos*/
function hourToSeconds($formatHour){
	
	$preAll=explode(':',$formatHour);
	$hourInSec[0]=(int)$preAll[0]*3600;
	$hourInSec[1]=(int)$preAll[1]*60;
	
	$hourInSecFinal=$hourInSec[0]+$hourInSec[1];
	
	return $hourInSecFinal;
	
}



?>