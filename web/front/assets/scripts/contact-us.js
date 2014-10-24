var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
	            lat: -21.785492,
				lng: -48.1623257,
			  });
			   var marker = map.addMarker({
		            lat: -21.785492,
					lng: -48.1623257,
		            title: '',
		            infoWindow: {
		                content: "<b>MCT</b> Rua Almirante Tamandaré, 521, Vila Xavier"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();