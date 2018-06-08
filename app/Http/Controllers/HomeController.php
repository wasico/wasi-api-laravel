<?php

namespace App\Http\Controllers;

use App\Providers\HttpRequestsProvider as ClientHttp;

class HomeController extends Controller {
	function index() {
		$properties = PropertiesController::getLatestProperties(11)['properties'];

		$firstFiveProperties = array_slice($properties, 1, 5);
		$nextSixProperties   = array_slice($properties, 5, 6);
		$clients             = $this->getClients();
		$contactInfo         = $this->getContactInfo();

		$mapProperties = PropertiesController::formatForMap($properties);

		return view('home.home', array(
				'firstFiveProperties' => $firstFiveProperties,
				'nextSixProperties'   => $nextSixProperties,
				'clients'             => $clients,
				'contactInfo'         => $contactInfo,
				'mapProperties'       => $mapProperties,
				'propertyTypes'       => PropertiesController::getAllPropertyTypes(),
				'propertyPurposes'    => PropertiesController::getPropertiesPurpose(),
				'priceRanges'         => PropertiesController::getPriceRange()
			));
	}

	function getClients() {
		$client = new ClientHttp('');
		$data   = $client->get('user/all-users');

		for ($i = 1; $i < sizeof($data)-1; $i++) {
			if ($data[$i]['user_type'] != 'REALTOR') {
				unset($data[$i]);
			}
		}

		return array_slice($data, 0, 4);
	}

	function getContactInfo() {
		$client = new ClientHttp('');
		$data   = $client->get('user/all-users');

		for ($i = 1; $i < sizeof($data)-1; $i++) {
			if ($data[$i]['user_type'] != 'REALTOR' && $data[$i]['has_profile']) {
				unset($data[$i]);
			}
		}

		return $data[0];
	}
}
