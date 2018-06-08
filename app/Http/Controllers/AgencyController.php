<?php

namespace App\Http\Controllers;

class AgencyController extends Controller {
	public function aboutUs() {
		return view('agency.about-us');
	}

	public function contactUs() {
		return view('agency.contact-us');
	}
}
