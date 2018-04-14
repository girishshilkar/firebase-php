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
class Scratch extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('scratch_model');

        $serviceAccount = ServiceAccount::fromJsonFile(APPPATH . 'libraries/vendor/kreait/firebase_credentials.json');
        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
    }

    public function scratch_business_list_get()
    {
        $res = $this->scratch_model->scratch_business_list();
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

    public function scratch_products_get()
    {
        $res = $this->scratch_model->scratch_prodcuts_list($this->get('id'));
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

    public function scratch_now_post()
    {
        $res = $this->scratch_model->scratch_now($this->post('id'));
        if ($res) {
//            generate win or lose condition
            $rand = mt_rand(0, 1);
            if ($rand) {
//                if win push all the product ids to the array
                $prod_array = array();
                foreach ($res as $prod) {
                    array_push($prod_array, $prod['id']);
                }
//                selecting random product from array
                $random_key = array_rand($prod_array, 1);
                $won = $prod_array[$random_key];
//                get the product name
                $product_won = array();

                foreach ($res as $prod) {
                    if ($prod['id'] == $won) {
                        $product_won = $prod;
                        break;
                    }
                }
//                update use limit for the product won
                $this->db->query("UPDATE scratchoffer set useLimit = useLimit-1 WHERE id = $won");
                $use_limit = $this->db->query("SELECT useLimit FROM scratchOffer WHERE id = $won");
                $product_won['useLimit'] = $use_limit->row()->useLimit;;
                $this->response(array(
                    'status' => true,
                    'code' => 200,
                    'data' => $product_won,
                ), REST_Controller::HTTP_OK);
            } else {
                $this->response(array(
                    'status' => true,
                    'code' => 404,
                    'data' => 'lost',
                ), REST_Controller::HTTP_OK);
            }

        }
        else {
            $this->response(array(
                'status' => false,
                'code' => 400,
                'data' => 'Sorry no products available'
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}