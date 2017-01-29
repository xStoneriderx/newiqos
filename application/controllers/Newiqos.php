<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newiqos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modeliqos');
    }
    public function test()
    {
        $data = array(
            'username'=>'qwert123y',
            'password'=>'qwerty',
        );
        $result = $this->modeliqos->create_login($data);
        print_r($result);
    }
	public function index()
	{
	    $post = array(
	        'username'=>'qwerty',
            'password'=>'qwerty',
            'city_id'=>'1',
            'permissions'=>'2'
        );
        $post_json = json_encode($post);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://newiqos/index.php/iqosrest/logins");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json"
		));

		$response = curl_exec($ch);
        $header = curl_getinfo($ch);
		curl_close($ch);
        $response = json_decode($response, true);
        print_r($response);
        print_r($header['http_code']);
	}
	
}
