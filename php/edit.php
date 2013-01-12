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
						$filename = 'test1.xml';
	
						$dom = new DomDocument('1.0', 'UTF-8');
						$dom->load($filename, LIBXML_NOBLANKS);
	
						$fireworksFactories = $dom->firstChild;
	
						$nodeDel = $_GET['ffs'];
						//echo("<br>Node to be Edited: " . $nodeDel);

						$del = $dom->getElementsByTagName('fireworksFact');

						$node1 = $del->item($nodeDel)->nodeValue;
						//echo("<br>Node Details: " . $node1);//output details
	
						$node2 = $del->item($nodeDel);
						/* $node2->parentNode->removeChild($node2); */
	
						$dom->formatOutput = true;
						// save XML as string or file 
						$test1 = $dom->saveXML(); // put string in test1
						$dom->save($filename); // save as file

						//echo "<br><br>Saving all the document:<br>";
						//echo $test1 . "<br>";
					?>
					
					<form id="addform" enctype="multipart/form-data" action="edit-pg2.php" method="post">
						<label>Node ID:</label>
						<input type="text" name="node" id="node" value="<?php echo $nodeDel ?>" readonly>
						<br>
						<label>Latitude:</label>
						<input type="text" name="lat" id="lat" value="1">			
						<label>Longitude:</label>
						<input type="text" name="long" id="long" value="2">
						<br>
						<label>Place Name:</label>
						<input type="text" name="placeName" id="placeName" placeholder="Name of the Place">
						<br>
						<label>Site Plan:</label>
						<input type="file" name="sitePlan" id="sitePlan">
						<br>
						<label>Images:</label>
						<input type="file" name="images[]" multiple="multiple">
						<br>
						<label>Personnel Details:</label>
						<textarea name="personnelDetails" id="personnelDetails" placeholder="Type Details Here."></textarea>
						<br>
						<label>Production Storage:</label>
						<textarea name="productionStorage" id="productionStorage" placeholder="Type Details about the production storage here."></textarea>
						<br>
						<input type="submit" value="Edit"> 
					</form>
					
					<script>
						var selectedRd = getQueryVariable("ffs");
						var xmlDoc = loadXml("test1.xml");
						getDetails(selectedRd, xmlDoc);

						function getQueryVariable(variable) {
							var query = window.location.search.substring(1);
							var vars = query.split("&");
							for (var i=0;i<vars.length;i++) {
								var pair = vars[i].split("=");
								if (pair[0] == variable) {
									return pair[1];
								}
							} 
							alert('Query Variable ' + variable + ' not found');
						}
						
						function loadXml(xmlUrl) {
							if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp = new XMLHttpRequest();
							} else { // code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.open("GET", xmlUrl, false);
							xmlhttp.send();
							xmlDoc = xmlhttp.responseXML;
							return xmlDoc;
						}
						
						function getDetails(variable, xmlDoc){
							var ffs = xmlDoc.getElementsByTagName('fireworksFact');
							var lat = ffs[variable].getElementsByTagName('lat')[0].childNodes[0].nodeValue;
							document.getElementById('lat').value = lat;
							
							var log = ffs[variable].getElementsByTagName('long')[0].childNodes[0].nodeValue;
							document.getElementById('long').value = log;
							
							var placeName = ffs[variable].getElementsByTagName('placeName')[0].childNodes[0].nodeValue;
							document.getElementById('placeName').value = placeName;
							
//check this							var sitePlan = ffs[variable].getElementsByTagName('sitePlan')[0].childNodes[0].nodeValue;
//check this							var imgs = ffs[variable].getElementsByTagName('placeName')[0].childNodes[0].nodeValue;

							var persDet = ffs[variable].getElementsByTagName('personnelDetails')[0].childNodes[0].nodeValue;
							document.getElementById('personnelDetails').value = persDet;
							
							var prodStr = ffs[variable].getElementsByTagName('productionStorage')[0].childNodes[0].nodeValue;
							document.getElementById('productionStorage').value = prodStr;
						}
					</script>
				</div>
			</div>
		</section>
	</body>
</html>