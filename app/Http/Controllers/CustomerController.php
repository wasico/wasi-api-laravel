<?php

namespace App\Http\Controllers;

use App\Providers\HttpRequestsProvider as ClientHttp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller {
	static function formatData($data) {
		$data['realtor'] = $data['realtor']['value'];
		$customer        = array(
			'id_user'          => $data['realtor']['id_user'],
			'id_client_type'   => 7, // new
			'id_client_status' => 1,
			'first_name'       => $data['name']['value'],
			'last_name'        => $data['lastname']['value'],
			'email'            => $data['email']['value'],
			'query'            => 'Asunto: '.$data['subject']['value'].'<br>'.'Mensaje: '.$data['message']['value'],
			'reference'        => 'Formulario de contacto',
			'send_information' => $data['receive_newsletter']['value'],
		);

		return $customer;
	}

	public function contactRealtor(Request $request) {
		$request   = $request->all();
		$data      = self::formatData($request);
		$recaptcha = $request['g-recaptcha-response']['value'];
		$client    = new ClientHttp('');

		$response = null;
		// Confirmacion del captcha
		if ($client->validateRecaptcha($recaptcha)) {
			$response = new Response($client->post('client/add', $data));
		} else {
			$response = new Response(400);
		}

		return $response;
	}
}