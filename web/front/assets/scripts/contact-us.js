var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
	            lat: -21.7854158,
				lng: -48.1609529,
			  });
			   var marker = map.addMarker({
		            lat: -21.7854158,
					lng: -48.1609529,
		            title: 'Vai',
		            infoWindow: {
		                content: "<b>MCT</b> Avenida Gutember, 166, Vila Xavier"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();