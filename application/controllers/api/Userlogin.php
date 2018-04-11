<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/vendor/autoload.php';

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
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
class Userlogin extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $serviceAccount = ServiceAccount::fromJsonFile(APPPATH . 'libraries/vendor/kreait/firebase_credentials.json');
        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
    }

    public function login_post()
    {
        $database = $this->firebase->getDatabase();

        $users = $database->getReference('user')->getSnapshot()->getValue();
        $result = array();
        foreach ($users as $id => $user) {
            if ($user['email'] == $this->post('email')) {
                if ($user['password'] == $this->post('password')) {
                    $user['user_id'] = $id;
                    $result = $user;
                }
            }
        }
        if (!empty($result)) {
            $this->response(array(
                'data' => $result,
                'status' => 1,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                'data' => 'Invalid credentials',
                'status' => 0,
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function signup_post()
    {
        $database = $this->firebase->getDatabase();
        $newPost = $database
            ->getReference('user')
            ->push([
                'firstName' => $this->post('fname'),
                'lastName' => $this->post('lname'),
                'email' => $this->post('email'),
                'password' => $this->post('password'),
                'mobile' => $this->post('phone'),
                'bonusPoints' => '',
                'scratchesFree' => '',
                'scratchesBought' => '',
                'blocked' => 0,
                'createdDatetime' => '',
                'lastloginDatetime' => '',
                'status' => 1,
            ]);

        if ($newPost->getKey()) {
            $this->response(array(
                'data' => $newPost->getKey(),
                'status' => 1,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                'data' => 'Bad request',
                'status' => 0,
            ), REST_Controller::HTTP_BAD_REQUEST);
        }

    }
}