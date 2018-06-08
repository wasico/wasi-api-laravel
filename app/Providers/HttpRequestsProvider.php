<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class HttpRequestsProvider extends ServiceProvider {
	private $apiUrl;
	private $headers;
	private $expiration;

    function __construct()
    {
        $this->apiUrl = env('API_URL');
        $this->headers = array('wasi_token' => env('WASI_TOKEN'), 'id_company' => env('ID_COMPANY'));
        $this->expiration = now()->addMonth();
    }

    private function validateOptions($options) {
		$opts = $this->headers;

		if ($options != null && sizeof($options) > 0) {
			$opts = array_merge($opts, $options);
		}

		return $opts;
	}

	public function validateRecaptcha($key) {
		$client   = new Client();
		$response = $client->post(env('GOOGLE_RECAPTCHA_VERIFY_URL'),
			['form_params' => [
					'secret'     => env('GOOGLE_RECAPTCHA_SECRET'),
					'response'   => $key
				]
			]
		);

		$body = json_decode((string) $response->getBody());
		return $body->success;
	}

	public function get($url, $options = []) {
		if (Cache::get($url.http_build_query($options)) == null) {
            $client = new Client();

            $body = $this->validateOptions($options);

            $response = $client->request('POST',
                $this->apiUrl . $url,
                [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' => (\GuzzleHttp\json_encode($body))
                ]
            );

            Cache::put($url.http_build_query($options),
                       array('params' => $options, 'result' => \GuzzleHttp\json_decode($response->getBody(), true)),
                       $this->expiration);

            return \GuzzleHttp\json_decode($response->getBody(), true);
        }

        return Cache::get($url.http_build_query($options))['result'];
	}

	public function post($url, $body) {
		$client = new Client();

		$body = $this->validateOptions($body);

		$response = $client->request('POST',
			$this->apiUrl.$url,
			[
				'headers'       => [
					'Content-Type' => 'application/json'
				],
				'body' => (\GuzzleHttp\json_encode($body))
			]
		);

		return $response->getStatusCode();
	}
}
