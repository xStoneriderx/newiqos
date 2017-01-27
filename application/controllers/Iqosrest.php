<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class IqosRest extends REST_Controller {
	
	public function index_get()
	{
		$this->response('123456');
	}

	public function index_post()
	{
		$this->response('bugaga', 201);
		
	}
}
