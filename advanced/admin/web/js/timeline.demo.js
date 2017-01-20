/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 2.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v2.0/admin/html/
*/

var handleGoogleMapSetting = function() {
	"use strict";
	var mapDefault;
	var cobaltStyles  = [{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":10},{"lightness":10},{"gamma":0.8},{"hue":"#293036"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#293036"}]}];
    
	function initialize() {
		var mapOptions = {
			zoom: 6,
			center: new google.maps.LatLng(-33.397, 145.644),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
		};
		mapDefault = new google.maps.Map(document.getElementById('google-map'), mapOptions);
        mapDefault.setOptions({styles: cobaltStyles});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	
};

var Timeline = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleGoogleMapSetting();
        }
    };
}();