<!DOCTYPE html>
<html>
	<head>
		<title>CSA3209 Assignment 2</title>
		
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<link rel="stylesheet" href="../css/stimenu.css" type="text/css">
		<link rel="stylesheet" href="../css/ff-menu.css" type="text/css">
		<link rel="stylesheet" href="css/bottom-menu.css" type="text/css">

		<link rel="stylesheet" href="../css/add.css" type="text/css">

		<script type="text/javascript" src="../js/maps/cpds-map.js"></script>
	</head>
	
	<body onload="getLocation('cpdstations.xml', true, false)">
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
			<div id="footer">
				<p><a href="http://www.mark-bonnici.com">designedbymark.com</a></p>
			</div>
		</div>
		
		<div id="mapholder"></div>
		
		<section id="addinfo-menu">
			<div id="ai-menu-back"></div>
			<div id="ai-menu-content">
				<div id="add-form">
					<?php
						$filename = 'cpdstations.xml';
	
						$dom = new DomDocument('1.0', 'UTF-8');
						$dom->load($filename, LIBXML_NOBLANKS);
	
						$fireworksFactories = $dom->firstChild;
	
						$nodeDel = $_GET['cpds'];
						//echo("<br>Node to be Edited: " . $nodeDel);

						$del = $dom->getElementsByTagName('station');

						$node1 = $del->item($nodeDel)->nodeValue;
						//echo("<br>Node Details: " . $node1);//output details
	
						$node2 = $del->item($nodeDel);
						$node2->parentNode->removeChild($node2);
	
						$dom->formatOutput = true;
						// save XML as string or file 
						$test1 = $dom->saveXML(); // put string in test1
						$dom->save($filename); // save as file
						
						echo "<br><br>Saving all the document:<br>";
						echo "<pre>".$test1 . "</pre><br>";
					?>
				</div>
			</div>
		</section>
		
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
		
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="../js/jquery.iconmenu.js"></script>
		
		<script type="text/javascript" src="../js/menu.js"></script>
	</body>
</html>

