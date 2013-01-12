<!DOCTYPE html>
<html>
	<head>
		<title>Fireworks Factories</title>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<link rel="stylesheet" href="../css/stimenu.css" type="text/css">
		<link rel="stylesheet" href="../css/ff-menu.css" type="text/css">
		<link rel="stylesheet" href="../css/bottom-menu.css" type="text/css">
		
		<link rel="stylesheet" href="../css/add.css" type="text/css">
	</head>
	 
	<body onload="getLocation()">
		<div id="side-menu">
			<div id="sideback"></div>
			<div id="sidecontents">
				<div id="logo">
					<a href="../index.html"><img src="../images/logo.png" alt="logo" width="170" height="170"></a>
				</div>
				
				<div id="menu">
					<ul id="sti-menu" class="sti-menu">
						<li data-hovercolor="#37c5e9">
							<a href="../fireworksfactories.html">
								<h2 data-type="mText" class="sti-item">Fireworks Factories</h2>
								<span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
							</a>
						</li>
						<li data-hovercolor="#ff395e">
							<a href="../cpdstations.html">
								<h2 data-type="mText" class="sti-item">CPD Stations</h2>
								<span data-type="icon" class="sti-icon sti-icon-alternative sti-item"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			
			<script type="text/javascript" src="../js/jquery.min.js"></script>
			<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
			<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
			<script type="text/javascript" src="../js/jquery.iconmenu.js"></script>
		
			<script type="text/javascript" src="../js/menu.js"></script>
			
			<div id="footer">
				<p><a href="http://www.mark-bonnici.com">designedbymark.com</a></p>
			</div>
		</div>
		
		<div id="mapholder"></div>
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="../js/maps/ff-map-edit.js"></script> <!-- ff-map-delete.js -->
		
		<section id="addinfo-menu">
			<div id="ai-menu-back"></div>
			<div id="ai-menu-content">
				<div id="add-form">
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
						
						
						////////////////////////////DELETE STARTS HERE////////////////////////////
						
						$filename = 'test1.xml';
						
						$dom = new DomDocument('1.0', 'UTF-8');
						$dom->load($filename, LIBXML_NOBLANKS);
						
						$fireworksFactories = $dom->firstChild;
						
						$nodeDel = $_POST['node'];
						echo("<br>node del: " . $nodeDel);
					
						$del = $dom->getElementsByTagName('fireworksFact');
					
						$node1 = $del->item($nodeDel)->nodeValue;
						echo("<br>node1: " . $node1);//output details
						
						$node2 = $del->item($nodeDel);
						$node2->parentNode->removeChild($node2);
						
						$dom->formatOutput = true;
					    // save XML as string or file 
					    $test1 = $dom->saveXML(); // put string in test1
					    $dom->save($filename); // save as file
					
					    echo "<br><br>Saving all the document:<br>";
					    echo $test1 . "<br>";
					    
					    /*
					    print '<script type="text/javascript">'; 
					    print 'alert("'. $node1 .' was deleted and XML document was saved")'; 
						print '</script>';  
						*/
						
						////////////////////////////DELETE STOPS HERE////////////////////////////
						
						

						////////////////////////////ADD STARTS HERE////////////////////////////
												
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
						for($i=0; $i<=count($_FILES['images']); $i++) {//-1
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
					    echo "<pre>" . $test1 . "</pre><br>";
					    
					    print '<script type="text/javascript">'; 
					    print 'alert("'. $nodeDel .' was edited and XML document was saved")'; 
						print '</script>';  
						
						////////////////////////////ADD STOPS HERE////////////////////////////
					?>
				</div>
			</div>
		</section>
	</body>
</html>