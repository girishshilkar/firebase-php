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
class Common_functions extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        
    }

	
	
    public function epoch_to_datetime_get()
    {
        $epoch = $this->get('epoch');
		$date = gmdate('r', $epoch);
		$this->set_response($date, REST_Controller::HTTP_OK);
    }

	
}
