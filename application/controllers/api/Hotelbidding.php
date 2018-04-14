<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/vendor/autoload.php';

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Hotelbidding extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $serviceAccount = ServiceAccount::fromJsonFile(APPPATH .'libraries/vendor/kreait/firebase_credentials.json');
        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $this->database = $this->firebase->getDatabase();

        $this->load->model('user1_model');
    }

    public function hotelbid_details_get()
    {
        $id = $this->get('id');
        $result = $this->user1_model->fetch_hotelbid_details($id);
        #$this->set_response($result, REST_Controller::HTTP_OK);
        #print_r($result);
        $this->response(array(
                'status' => true,
                'code' => 200,
                'data' => $result
            ), REST_Controller::HTTP_OK);
        else
        {
            $this->response(array(
                'status' => false,
                'code' => 400
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function hotelbidding_live_get()
    {
        $result = $this->user1_model->fetch_hotelbidding_live();
        #$this->set_response($result, REST_Controller::HTTP_OK);
        #print_r($result);
        $this->response(array(
                'status' => true,
                'code' => 200,
                'data' => $result
            ), REST_Controller::HTTP_OK);
    }

    public function hotelbidding_upcoming_get()
    {
        $result = $this->user1_model->fetch_hotelbidding_upcoming();
        #$this->set_response($result, REST_Controller::HTTP_OK);
        #print_r($result);
        $this->response(array(
                'status' => true,
                'code' => 200,
                'data' => $result
            ), REST_Controller::HTTP_OK);
    }

   
    

}
