<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class IqosRest extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modeliqos');
    }

	public function index_get()
	{

	}

	public function index_post()
	{
        $this->response($this->post(), 203);

	}
    public function clients_get()
    {




    }
    public function clients_post()
    {
        $data = $this->post();
        $response = $this->modeliqos->new_client($data);
        $this->response($response);

    }

    /*LOGINS START*/
    public function logins_post()
    {
        $data = $this->post();
        $data['salt'] = $this->generateSalt();
        $result = $this->modeliqos->create_login($data);
        if (isset($result['id'])) {
            $this->response(['created_id'=>$result['id']], 201);
        } else {
            $this->response($result, $result['code']);
        }

    }
    /*LOGINS END*/
    public function generateSalt($length = 4){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
}
