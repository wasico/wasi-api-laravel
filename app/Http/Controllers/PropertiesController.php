<?php

namespace App\Http\Controllers;

use App\Providers\HttpRequestsProvider as ClientHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PropertiesController extends Controller {
	public function getProperties(Request $request) {
		$regQty   = 5;
		$page     = $request->get('page', 1);
		$criteria = self::getSearchCriteriaProperties($request);

		$properties = self::getLatestProperties($regQty, $page, $criteria);

		$count      = $properties['total_prop'];
		$totalPages = self::getQtyOfPages($count, $regQty);

		return view('properties.properties-content',
			array(
				'properties'      => $properties['properties'],
				'totalProperties' => $count,
				'totalPages'      => $totalPages,
				'currentPage'     => $page,
			)
		);
	}

	static function getQtyOfPages($count, $regQty = 5) {
		return $count % $regQty == 0 ? $count / $regQty : floor($count / $regQty) + 1;
	}

	public static function getLatestProperties($qty = 5, $page = 1, $criteria = null) {
		$client = new ClientHttp('');

		$searchArray = array(
			'id_availability' => 1,
			'take'            => $qty,
			'scope'           => 1,
			'skip'            => ($page - 1) * $qty
		);

		if ($criteria != null) {
			$searchArray = array_merge($searchArray, $criteria);
		}

		$data       = $client->get('property/search', $searchArray);
		$properties = [];
		for ($i = 0; $i < sizeof($data)-2; $i++) {
			if (gettype($data[$i]) == 'array') {
                $data[$i]['latitude'] = (float)$data[$i]['latitude'];
                $data[$i]['longitude'] = (float)$data[$i]['longitude'];
				$data[$i]['unit_area_label']       = self::getUnitAreaLabel($data[$i]['id_unit_area']);
				$data[$i]['unit_built_area_label'] = self::getUnitAreaLabel($data[$i]['id_unit_built_area']);
                $data[$i]['image'] = isset($data[$i]['galleries']) && sizeof($data[$i]['galleries']) > 0 ? $data[$i]['galleries'][0][0]['url'] : '';
                $data[$i]['image_description'] = isset($data[$i]['galleries']) && sizeof($data[$i]['galleries']) > 0 ? $data[$i]['galleries'][0][0]['description'] : '';

				$properties[$i] = $data[$i];
			}
		}

		return array('properties' => $properties, 'total_prop' => $data['total']);
	}

	public static function formatForMap($properties) {
		$formattedProperties = [];

		foreach ($properties as $key => $property) {
			$formattedProperties[$key] = array(
				'id'              => $property['id_property'],
				'title'           => $property['title'],
				'latitude'        => $property['latitude'],
				'longitude'       => $property['longitude'],
				'image'           => $property['image'],
				'description'     => $property['address'].'<br>'.$property['region_label'].', '.$property['city_label'].', '.$property['country_label'],
				'link'            => 'propiedades/propiedad/'.$property['id_property'],
				'map_marker_icon' => 'images/markers/coral-marker-residential.png',

			);
		}

		return $formattedProperties;
	}

	static function getUnitAreaLabel($label) {
		$unit = '';

		switch ($label) {
			case '1':
				$unit = 'm2';
				break;
			case '2':
				$unit = 'cuadras';
				break;
			case '3':
				$unit = 'hectáreas';
				break;
			case '4':
				$unit = 'varas';
				break;
		}

		return $unit;
	}

	public static function getPropertyTypesByPurpose($purpose) {
		$client = new ClientHttp('');
		$data   = $client->get('property-type/all', array(
				'quantity' => true,
				'scope'    => 1,
				$purpose   => true
			)
		);

		$ptypes = [];
		for ($i = 0; $i < sizeof($data)-1; $i++) {
			if (gettype($data[$i]) == 'array') {
				$ptypes[$i] = $data[$i];
			}
		}

		return $ptypes;
	}

	public static function getPropertiesPurpose() {
		$ppurpose = [
			'Venta',
			'Alquiler',
			'Transferencia'
		];

		return $ppurpose;
	}

	public static function getAllPropertyTypes() {
		$client = new ClientHttp('');
		$data   = $client->get('property-type/all', array(
				'quantity' => true,
				'scope'    => 1,
			)
		);

		$pptypes = [];
		for ($i = 0; $i < sizeof($data)-1; $i++) {
			if (gettype($data[$i]) == 'array') {
				$pptypes[$i] = $data[$i];
			}
		}

		return $pptypes;
	}

	public static function getPriceRange() {
		$client = new ClientHttp('');
		$data   = $client->get('property/price-range');

		return $data;
	}

	public static function getAreaRange() {
		$client = new ClientHttp('');
		$data   = $client->get('property/area-range');

		return $data;
	}

	public static function getSearchCriteriaProperties(Request $request) {
		$searchArray = array(
			'match'            => $request->input('location', ''),
			'id_property_type' => $request->input('search_prop_type', 0),
			'for_sale'         => $request->input('search_status') == 'Venta',
			'for_rent'         => $request->input('search_status') == 'Alquiler',
			'bathrooms'        => $request->input('search_bathrooms', 0),
			'min_bedrooms'     => $request->input('search_bedrooms', 0),
			'min_built_area'   => $request->input('search_minarea', 0),
			'min_area'         => $request->input('search_minarea', 0),
			'max_built_area'   => $request->input('search_maxarea', 0),
			'max_area'         => $request->input('search_maxarea', 0),
			'min_price'        => $request->input('search_minprice', 0),
			'max_price'        => $request->input('search_maxprice', 0),
			'id_city'          => $request->get('id_city', 0),
			'id_region'        => $request->get('id_region', 0)
		);

		return $searchArray;
	}

	public function searchProperties(Request $request) {
		return $this->getProperties($request);
	}

	public function getPropertyTypeLabel($idPropertyType) {
		$data  = self::getAllPropertyTypes();
		$index = array_search($idPropertyType, array_column($data, 'id_property_type'));

		return $data[$index]['nombre'];
	}

	public function getProperty($idProperty) {
		$client   = new ClientHttp('');
		$property = $client->get('property/get/'.$idProperty);

		$property['property_type_label']   = $this->getPropertyTypeLabel($property['id_property_type']);
		$property['unit_area_label']       = self::getUnitAreaLabel($property['id_unit_area']);
		$property['unit_built_area_label'] = self::getUnitAreaLabel($property['id_unit_built_area']);
        $property['latitude'] = (float)$property['latitude'];
        $property['longitude'] = (float)$property['longitude'];
        $property['image'] = isset($property['galleries']) && sizeof($property['galleries']) > 0 ? $property['galleries'][0][0]['url'] : '';
        $property['image_description'] = isset($property['galleries']) && sizeof($property['galleries']) > 0 ? $property['galleries'][0][0]['description'] : '';

        $user              = $client->get('user/get/'.$property['id_user']);
		$similarProperties = self::getLatestProperties(6, 1, array(
				'id_property_type' => $property['id_property_type'],
				'id_region'        => $property['id_region'],
			))['properties'];

		return view('properties.property-detail.property-detail-content',
			array(
				'property'          => $property,
				'realtor'           => $user,
				'similarProperties' => $similarProperties,
			)
		);
	}

}
