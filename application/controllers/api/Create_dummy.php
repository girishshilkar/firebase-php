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
class Create_dummy extends REST_Controller
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

    public function grandprize_get()
    {
        $database = $this->firebase->getDatabase();

        $newPost = $database
            ->getReference('grandPrize')
            ->push([
                'name' => 'Hyundai i20',
                'desc' => 'Runs Fast',
                'startPrice' => 600000,
                'endPrice' => 400000,
                'StartAtTime' => 1523793109,
                'timerStep' => 300,
                'priceStep' => 5000,
                'entryFee' => 5,
                'images' => '',
                'createdDatetime' => 1523361109,
                'updatedDatetime' => 1523361109,
                'status' => 0
            ]);

        $newPost = $database
            ->getReference('grandPrize')
            ->push([
                'name' => 'Yamaha FZ S',
                'desc' => 'Super responsive engine',
                'startPrice' => 60000,
                'endPrice' => 40000,
                'StartAtTime' => 1523793109,
                'timerStep' => 300,
                'priceStep' => 500,
                'entryFee' => 5,
                'images' => '',
                'createdDatetime' => 1523361109,
                'updatedDatetime' => 1523361109,
                'status' => 0
            ]);
    }


    public function getfirstkey($list)
    {
        foreach($list as $key1=>$value1)
        { 
            $key = $key1;
            break;
        }
        return $key;
    }

    public function getId($table,$column,$value)
    {
        $database = $this->firebase->getDatabase();
        $category = $database->getReference($table)->orderByChild($column)->equalTo($value)->getSnapshot()->getValue();
        return $this->getfirstkey($category);
    }


    public function hotelbidding_get()
    {
        $database = $this->firebase->getDatabase();
        
        $businessId = $this->getId('business','name','Taj Vivanta');
        
        $newPost = $database
            ->getReference('bidOffer')
            ->push([
                'name' => '2 Nights & 3 days',
                'desc' => 'Woohoo',
                'startPrice' => 20000,
                'endPrice' => 10000,
                'validityStart' => 1523793109,
                'validityEnd' => 1523893109,
                'StartAtTime' => 1523793109,
                'timerStep' => 300,
                'priceStep' => 1000,
                'images' => '',
                'businessId' => $businessId,
                'createdDatetime' => 1523361109,
                'updatedDatetime' => 1523361109,
                'status' => 0
            ]);

        $businessId = $this->getId('business','name','Deltin Royale');
        $newPost = $database
            ->getReference('bidOffer')
            ->push([
                'name' => '2 Nights Premium Package',
                'desc' => 'Woohoo',
                'startPrice' => 20000,
                'endPrice' => 10000,
                'validityStart' => 1523793109,
                'validityEnd' => 1523893109,
                'StartAtTime' => 1523793109,
                'timerStep' => 300,
                'priceStep' => 1000,
                'images' => '',
                'businessId' => $businessId,
                'createdDatetime' => 1523361109,
                'updatedDatetime' => 1523361109,
                'status' => 0
            ]);

    }


    public function business_get()
    {
        $database = $this->firebase->getDatabase();

        #Add Taj Vivanta

        #Get category Id and City Id
        $cityId = $this->getId('city','name','Panaji');
        $categoryId = $this->getId('category','name','Restaurant');

        #Add Business
        $newPost = $database
            ->getReference('business')
            ->push([
                'name' => 'Taj Vivanta',
                'contactPerson' => 'Ajay',
                'mobile' => 9888888880,
                'email' => 'ajay@gmail.com',
                'cityId' => $cityId,
                'createdDatetime' => 1523361109,
                'updatedDatetime' => 1523361109,
                'status' => 0
            ]);

        #Add Category
        $businessId = $newPost->getKey(); 

        $newPost = $database
            ->getReference('businessCategory')
            ->push([
                'businessId' => $businessId,
                'categoryId' => $categoryId,
                'status' => 0
            ]);


        #Add Deltin Royale
        #Get category Id and City Id
        $cityId = $this->getId('city','name','Panaji');
        $categoryId = $this->getId('category','name','Casino');

        #Add Business
        $newPost = $database
            ->getReference('business')
            ->push([
                'name' => 'Deltin Royale',
                'contactPerson' => 'Raj',
                'mobile' => 972345678,
                'email' => 'raj@gmail.com',
                'cityId' => $cityId,
                'createdDatetime' => 1523361109,
                'updatedDatetime' => 1523361109,
                'status' => 0
            ]);

        #Add Category
        $businessId = $newPost->getKey(); 

        $newPost = $database
            ->getReference('businessCategory')
            ->push([
                'businessId' => $businessId,
                'categoryId' => $categoryId,
                'status' => 0
            ]);

    }


    public function category_get()
    {
        $database = $this->firebase->getDatabase();
        $newPost = $database->getReference('category');

        $newPost->push([
                'name' => 'Restaurant',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Casino',
                'status' => 0
            ]);
    }


    public function city_get()
    {
        $database = $this->firebase->getDatabase();

        $newPost = $database->getReference('city');

        $newPost->push([
                'name' => 'Bangalore',
                'state' => 'Karnataka',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Panaji',
                'state' => 'Goa',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Mumbai',
                'state' => 'Maharashtra',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Pune',
                'state' => 'Maharashtra',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Kolkata',
                'state' => 'West Bengal',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Hyderabad',
                'state' => 'Andhra Pradesh',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Chennai',
                'state' => 'Tamil Nadu',
                'status' => 0
            ]);

        $newPost->push([
                'name' => 'Delhi',
                'state' => 'Delhi',
                'status' => 0
            ]);

        #$uri = $newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
        #$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-
        #$this->set_response(json_decode($uri), REST_Controller::HTTP_OK);
    }


}
