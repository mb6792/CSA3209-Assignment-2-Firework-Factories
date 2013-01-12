<?php
	$filename = 'test1.xml';
	
	$dom = new DomDocument('1.0', 'UTF-8');
	$dom->load($filename, LIBXML_NOBLANKS);
	
	$fireworksFactories = $dom->firstChild;
	
	$nodeDel = $_POST['ffs'];
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
    
    print '<script type="text/javascript">'; 
    print 'alert("'. $node1 .' was deleted and XML document was saved")'; 
	print '</script>';  
?>