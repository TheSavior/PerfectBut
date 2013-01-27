$(document).ready(function() {
	getPermission(); // call this when/before posting
});

function getPermission() {
	if (Modernizr.geolocation) {
		navigator.geolocation.getCurrentPosition(getPosition,getPositionFailure);	// Callback is getPostion, gets called after user gives permission	
	} else {
		// no native support; set location value = IP
	
	}
}

/*					x:y
input type="hidden" name="location" value="IP" id="postButton" />
*/

// Change postButton's value to 
function getPosition(position) {
	var lat = position.latitude;
	var longitude = position.longitude;

	//$(#postButton).value = 
	var locationVal = (lat + ":" + longitude);
	console.log(locationVal);
}

function getPositionFailure (err) {
	// err == 1 permission denied
	// err == 2 position   unavailable
	// err == 3 position   timeout
	console.log("failure to launch");
	console.log(err);

}