<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newiqos extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://t-sales.com.ua/index.php/iqosrest");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json"
		));

		$response = curl_exec($ch);
		curl_close($ch);
		var_dump($response);
	}
	
}
