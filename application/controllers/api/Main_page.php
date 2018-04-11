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
class Main_page extends REST_Controller
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
    }


    public function hotelbidding_get()
    {
        $database = $this->firebase->getDatabase();
        
        #get snapshot of Hotelbidding & business table
        $hotelbidding = $database->getReference('bidOffer')->getSnapshot();
        $business = $database->getReference('business')->getSnapshot();
                            
        $list = $hotelbidding->getValue();

        foreach($list as $key1=>$value1) 
        { 
            $temp = $hotelbidding->getChild('"'.$key1.'"')->getChild('businessId')->getValue();
            $temp1 = $business->getChild('"'.$temp.'"')->getValue();

            $list[$key1]['business_name']=$temp1['name'];
            #echo '<br>';
        }

        #echo "<pre>";
        #print_r($list);
        #echo "</pre>";

        $this->set_response($list, REST_Controller::HTTP_OK);
    }

    

}
