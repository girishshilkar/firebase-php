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
class User extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('user_model');

        $serviceAccount = ServiceAccount::fromJsonFile(APPPATH . 'libraries/vendor/kreait/firebase_credentials.json');
        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
    }

    public function login_post()
    {
        $result = $this->user_model->user_login();

        if ($result) {
//            first time login
            $free_scratches = $result->scratchesFree;
            $bonus_points = $result->bonusPoints;
            $daily_scratch = 0;
            if ($result->lastloginDatetime == '0000-00-00 00:00:00') {
                $free_scratches += 1;
                $bonus_points += 1;
                $daily_scratch += 1;
            } else {
                $date1 = new DateTime($result->lastloginDatetime);
                $date2 = new DateTime(date('Y-m-d'));
//          if date diff more than 0 add 1 scratch to got_scratch
                if ($date2->diff($date1)->format("%a") > 0) {
                    $free_scratches += 1;
                    $bonus_points += 1;
                    $daily_scratch += 1;
                }

            }
            $result->daily_scratch = $daily_scratch;
//            update last login datetime and free scratch logic
            $data = array(
                'lastloginDatetime' => date('Y-m-d H:i:s'),
                'scratchesFree' => $free_scratches,
                'bonusPoints' => $bonus_points
            );
            $this->db->where('id', $result->id);
            $this->db->update('users', $data);

            $this->response(array(
                'status' => true,
                'code' => 200,
                'data' => $result
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                'status' => false,
                'code' => 400
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function signup_post()
    {
        $res = $this->user_model->user_signup();

        if ($res) {
            $this->response(array(
                'status' => true,
                'code' => 200,
                'data' => array('id' => $res)
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                'status' => false,
                'code' => 400,
                'data' => 'Email already exists'

            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function user_info_get()
    {
        $res = $this->user_model->get_user_info();
        if ($res) {
            $this->response(array(
                'status' => true,
                'code' => 200,
                'data' => $res,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                'status' => false,
                'code' => 400,
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}