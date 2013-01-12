<?php
	$filename = 'cpdstations.xml';
	if(file_exists($filename)){
		echo("<br><br>file exists");
		$dom = new DomDocument('1.0', 'UTF-8');
		$dom->load($filename, LIBXML_NOBLANKS);
		
		$cpdsStations = $dom->firstChild;
	}else{
		echo("<br><br>file does not exist");
		$dom = new DomDocument('1.0', 'UTF-8');
		
		$cpdsStations = $dom->createElement('cpds-stations');
		$cpdsStations = $dom->appendChild($cpdsStations);
	}
	
	$station = $dom->createElement('station');
	$station = $cpdsStations->appendChild($station);
		
	$latitude = $dom->createElement('lat');
	$latitude = $station->appendChild($latitude);
	$lat = $dom->createTextNode($_POST["lat"]);
	$lat = $latitude->appendChild($lat);
	
	$longitude = $dom->createElement('long');
	$longitude = $station->appendChild($longitude);
	$long = $dom->createTextNode($_POST["long"]);
	$long = $longitude->appendChild($long);

	$placeName = $dom->createElement('placeName');
	$placeName =$station->appendChild($placeName);
	$name = $dom->createTextNode($_POST["placeName"]);
	$name = $placeName->appendChild($name);
	
    $dom->formatOutput = true;
    // save XML as string or file 
    $test1 = $dom->saveXML(); // put string in test1
    $dom->save($filename); // save as file

    echo "<br><br>Saving all the document:<br>";
    echo "<pre>".$test1 . "</pre><br>";
?>