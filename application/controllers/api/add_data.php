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
class add_data extends REST_Controller
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

        $this->load->model('add_data_model');
    }

    public function add_grandprize_get()
    {

        $this->add_data_model->add_grandprize();
                            
    }

    public function add_bidoffer_get()
    {

        $this->add_data_model->add_bidoffer();
                            
    }

    public function add_business_get()
    {

        $this->add_data_model->add_business();
                            
    }

    public function add_category_get()
    {

        $this->add_data_model->add_category();
                            
    }

    public function add_city_get()
    {

        $this->add_data_model->add_city();
                            
    }


}
