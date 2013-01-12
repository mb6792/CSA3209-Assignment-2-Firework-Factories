var x=document.getElementById("demo");
var map;

function getLocation(){
	if (navigator.geolocation){
		navigator.geolocation.getCurrentPosition(showPosition,showError);
	}else{
		x.innerHTML="Geolocation is not supported by this browser.";
	}
}

function showPosition(position){
	lat=position.coords.latitude;
	lon=position.coords.longitude;
	latlon=new google.maps.LatLng(lat, lon);
	mapholder=document.getElementById('mapholder');
	mapholder.style.height='100%';
	mapholder.style.width='100%';

	var myOptions={
		center:latlon,zoom:13,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl:true,
		mapTypeControlOptions:{
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		navigationControlOptions:{
			style:google.maps.NavigationControlStyle.DEFAULT,
			position: google.maps.ControlPosition.RIGHT_CENTER
		}
	};
	
	map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
	
	if(fileExists("php/test1.xml")){
		var xmlDoc = loadXml("php/test1.xml");
		createMarkers(xmlDoc);
	}else{
		alert("XML File Not Found!");
	}
	
}

function fileExists(fileLocation) {
    var response = $.ajax({
        url: fileLocation,
        type: 'HEAD',
        async: false
    }).status;
    return response;
}

function showError(error){
	switch(error.code){
		case error.PERMISSION_DENIED:
			x.innerHTML="User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			x.innerHTML="Location information is unavailable."
			break;
		case error.TIMEOUT:
			x.innerHTML="The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			x.innerHTML="An unknown error occurred."
			break;
	}
}

function parseXml(xmlText) {
	var xmlDoc;
	if (window.DOMParser) {
		parser = new DOMParser();
		xmlDoc = parser.parseFromString(xmlText, "text/xml");
	} else { // Internet Explorer
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = "false";
		xmlDoc.loadXML(xmlText);
	}
	return xmlDoc;
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

function createMarkers(xmlDoc) {
	var ffs = xmlDoc.getElementsByTagName('fireworksFact');
	
	var ni = document.getElementById('innerDiv');

	
	var pinImageFF = new google.maps.MarkerImage("images/fireworks.png",
		new google.maps.Size(32, 37),
		new google.maps.Point(0,0),
		new google.maps.Point(15, 37));
	
	for (var i = 0; i < ffs.length; i++) {
		var lat = ffs[i].getElementsByTagName('lat')[0].childNodes[0].nodeValue;
		var lg = ffs[i].getElementsByTagName('long')[0].childNodes[0].nodeValue;
		var placeName = ffs[i].getElementsByTagName('placeName')[0].childNodes[0].nodeValue;
		
		var latlng = new google.maps.LatLng(lat, lg);
		
		var newdiv = document.createElement('div');
		newdiv.setAttribute('id', 'ffSelection'+i);
		newdiv.setAttribute('class', 'rdBtns');
		newdiv.innerHTML = "<input type='radio' class='radioBtns' name='ffs' value='"+ i +"'>";
		newdiv.innerHTML += "<label for='rb"+ i + "'>"+placeName+"</label>";
		ni.appendChild(newdiv);
		
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: placeName,
			icon: pinImageFF,
		});
	}
	
	var pinColor = "FE7569";
	var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
		new google.maps.Size(21, 34),
		new google.maps.Point(0,0),
		new google.maps.Point(10, 34));
	var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
		new google.maps.Size(40, 37),
		new google.maps.Point(0, 0),
		new google.maps.Point(12, 35));
		
	var marker=new google.maps.Marker({
		position:latlon,
		map:map,
		title:"You are here!",
		icon: pinImage,
		shadow: pinShadow
	});
}