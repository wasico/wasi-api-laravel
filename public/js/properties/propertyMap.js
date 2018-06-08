'use strict';

function initPropertyMap() {
	const $mapPropertyElement = document.getElementById('property_location');
	const map = new google.maps.Map($mapPropertyElement, {
		zoom: 14	,
		center: mapData.coordinates
	});

	const marker = new google.maps.Marker({
		position: mapData.coordinates,
		map: map,
		icon: mapData.icon
	});
}

$(document).on('ready', () => {
	google.maps.event.addDomListener(window, 'load', initPropertyMap);
});

