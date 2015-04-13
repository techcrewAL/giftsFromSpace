<?php

function photo_of_the_day($m, $d, $y) {
	if ( isset($m) &&  !empty($m) && !empty($d) && !empty($y) && isset($d) && isset($y) )
		$jsoncontent=file_get_contents("https://api.data.gov/nasa/planetary/apod?date=$y-$m-$d&concept_tags=True&api_key=IxSeE5q9mksATRFb4cWYiBBDKZd3JY3Dtr58AOtE");
	else 
		$jsoncontent=file_get_contents("https://api.data.gov/nasa/planetary/apod?concept_tags=True&api_key=IxSeE5q9mksATRFb4cWYiBBDKZd3JY3Dtr58AOtE");
	
	$priceusd=json_decode($jsoncontent);
	return $priceusd->url;
}


function photo_of_the_sun($m, $d , $y) {
	if ( $m != null && $d != null && $y != null )
		return "http://sdowww.lmsal.com/sdomedia/SunInTime/$y/$m/$d/f0193.jpg"; // verdhe orig-f0171.jpg /f0304.jpg
	else
		return "http://sdowww.lmsal.com/sdomedia/SunInTime/". date("Y") ."/". date("m") ."/". date("d") ."/f0193.jpg";
}

function photo_of_the_milky_way() {
	return "http://www.dailygalaxy.com/.a/6a00d8341bf7f753ef019b003e90e1970b-pi";
}

function photo_of_the_earth() {
	return "http://www.bibliotecapleyades.net/imagenes_universo/cosmos05_06.jpg";
}

function random_photo() {
	return "http://www.spaceweather.com/images2006/05dec06/flare_sxi.gif";
}
?>