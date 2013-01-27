"use strict";
var MAPS = "http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=false";
var IP_GET = "http://jsonip.com/";
var IP_TO_LOC = "http://www.geoplugin.net/json.gp";
var locationVal;

$(document).ready(function() {
	//getPermission(); // call this when/before posting
	ajaxIP();
});

function getPermission() {
	if (Modernizr.geolocation) {
		navigator.geolocation.getCurrentPosition(getPosition,getPositionFailure);	// Callback is getPostion, gets called after user gives permission	
	} else {
		
	
	}
}

function ajaxIP() {
	$.ajax({
		dataType: "jsonp",
		url: IP_GET,
		success: getLocFromIP
	});
}

function getLocFromIP(ajax) {
	var ip = ajax.ip
	$.ajax({
		dateType: "jsonp",
		url: IP_TO_LOC,
		data: {"ip" : ip},
		success: locFinder
	});
}

/*					x:y
input type="hidden" name="location" value="IP" id="postButton" />
*/

function locFinder(ajax) {
	console.log(ajax);
}

// Change postButton's value to 
function getPosition(position) {

	var lat = position.coords.latitude;
	var longitude = position.coords.longitude;
	locationVal = (lat + "," + longitude);
	$.ajax({
		dataType: "jsonp",
		url: MAPS,
		success: getCity

	});
	//$(#postButton).value = 
	console.log(locationVal);
	console.log(position);

}

// Can be used to get different types of 
function getCity(response) {
	console.log(response.results);
	var city = response.results[3].address_components[4].long_name;
	console.log(city);
}

function getPositionFailure (err) {
	// err == 1 permission denied
	// err == 2 position   unavailable
	// err == 3 position   timeout
	console.log("failure to launch");
	console.log(err);

}