<?php
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["sitePlan"]["name"]));
	if ((($_FILES["sitePlan"]["type"] == "image/gif")
		|| ($_FILES["sitePlan"]["type"] == "image/jpeg")
		|| ($_FILES["sitePlan"]["type"] == "image/png")
		|| ($_FILES["sitePlan"]["type"] == "image/pjpeg"))
	&& ($_FILES["sitePlan"]["size"] < 20000000)
	&& in_array($extension, $allowedExts)){
		if ($_FILES["sitePlan"]["error"] > 0){
			echo "Return Code: " . $_FILES["sitePlan"]["error"] . "<br>";
		}else{
			echo "Upload: " . $_FILES["sitePlan"]["name"] . "<br>";
			echo "Type: " . $_FILES["sitePlan"]["type"] . "<br>";
			echo "Size: " . ($_FILES["sitePlan"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["sitePlan"]["tmp_name"] . "<br>";
	
			if (file_exists("../uploads/" . $_FILES["sitePlan"]["name"])){
				echo $_FILES["sitePlan"]["name"] . " already exists. ";
			}else{
				move_uploaded_file($_FILES["sitePlan"]["tmp_name"],
					"../uploads/" . $_FILES["sitePlan"]["name"]);
				echo "Stored in: " . "../uploads/" . $_FILES["sitePlan"]["name"] ."<br>";
			}
		}
	}else{
		echo "Invalid file";
	}	
	
	for($i=0; $i<=count($_FILES['images']); $i++) {
	  //Get the temp file path
	  $tmpFilePath = $_FILES['images']['tmp_name'][$i];
	
	  //Make sure we have a filepath
	  if ($tmpFilePath != ""){
	    //Setup our new file path
	    $newFilePath = "../uploads/" . $_FILES['images']['name'][$i];
	
	    //Upload the file into the temp dir
	    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
	
	      //Handle other code here
	      echo "<br>Stored in: " . "../uploads/" . $_FILES["images"]["name"][$i];
	    }
	  }
	}
	
	$filename = 'test1.xml';
	if(file_exists($filename)){
		echo("<br><br>file exists");
		$dom = new DomDocument('1.0', 'UTF-8');
		$dom->load($filename, LIBXML_NOBLANKS);
		
		$fireworksFactories = $dom->firstChild;
	}else{
		echo("<br><br>file does not exist");
		$dom = new DomDocument('1.0', 'UTF-8');
		
		$fireworksFactories = $dom->createElement('fireworksFactories');
		$fireworksFactories = $dom->appendChild($fireworksFactories);
	}
	
	$fireworksFact = $dom->createElement('fireworksFact');
	$fireworksFact = $fireworksFactories->appendChild($fireworksFact);
		
	$latitude = $dom->createElement('lat');
	$latitude = $fireworksFact->appendChild($latitude);
	$lat = $dom->createTextNode($_POST["lat"]);
	$lat = $latitude->appendChild($lat);
	
	$longitude = $dom->createElement('long');
	$longitude = $fireworksFact->appendChild($longitude);
	$long = $dom->createTextNode($_POST["long"]);
	$long = $longitude->appendChild($long);

	$placeName = $dom->createElement('placeName');
	$placeName =$fireworksFact->appendChild($placeName);
	$name = $dom->createTextNode($_POST["placeName"]);
	$name = $placeName->appendChild($name);
	
	$sitePlan = $dom->createElement('sitePlan');
	$sitePlan = $fireworksFact->appendChild($sitePlan);
	$planPath = $dom->createTextNode($_FILES["sitePlan"]["name"]);
	$planPath = $sitePlan->appendChild($planPath);
	
	//add images
	$images = $dom->createElement('images');
	$images = $fireworksFact->appendChild($images);
/* 	for($i=0; $i<count($_FILES['images'])-1; $i++) { */
	for($i=0; $i<=count($_FILES['images']); $i++) {
		$image = $dom->createElement('image');
		$image = $images->appendChild($image);
		$imagePath = $dom->createTextNode($_FILES["images"]["name"][$i]);
		$imagePath = $image->appendChild($imagePath);
	}

    $personnelDetails = $dom->createElement('personnelDetails');
    $personnelDetails = $fireworksFact->appendChild($personnelDetails);
	$pd = $dom->createTextNode($_POST["personnelDetails"]);
	$pd = $personnelDetails->appendChild($pd);

    $productionStorage = $dom->createElement('productionStorage');
    $productionStorage = $fireworksFact->appendChild($productionStorage);    
    $ps = $dom->createTextNode($_POST["productionStorage"]);
	$ps = $productionStorage->appendChild($ps);
    
    $dom->formatOutput = true;
    // save XML as string or file 
    $test1 = $dom->saveXML(); // put string in test1
    $dom->save('test1.xml'); // save as file

    echo "<br><br>Saving all the document:<br>";
    echo "<pre>".$test1 . "</pre><br>";
?>