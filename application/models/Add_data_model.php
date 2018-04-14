<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// save ,update all the details of registration form,renew form,upgrade form etc
 class Add_data_Model extends CI_Model
 {  
    public function __construct()
        {  
            date_default_timezone_set('Asia/Kolkata');
            $this->load->database();
        }


     public function add_grandprize()
    {

          $data = array( array (
                            'name' => 'Hyundai i20',
                            'description' => 'Runs Fast',
                            'startPrice' => 600000,
                            'endPrice' => 400000,
                            'StartAtTime' => date('Y-m-d H:i:s',time()+300),
                            'timerStep' => 300,
                            'priceStep' => 5000,
                            'entryFee' => 10
                            
                        ),
                        array (
                            'name' => 'Yamaha FZ S',
                            'description' => 'Super responsive engine',
                            'startPrice' => 60000,
                            'endPrice' => 40000,
                            'StartAtTime' => date('Y-m-d H:i:s',time()+3000),
                            'timerStep' => 300,
                            'priceStep' => 500,
                            'entryFee' => 5
                        )
                        
                    );

          $this->db->insert_batch('grandprize', $data); 
    }    

     public function add_bidoffer()
    {

          $businessId = $this->getId('business','name','Taj Vivanta');
          $businessId1 = $this->getId('business','name','Deltin Royale');

          #$date = strtotime(date('Y-m-d H:i:s'));

          $data = array( array (
                            'name' => '2 Nights & 3 days',
                            'description' => 'Woohoo',
                            'startPrice' => 20000,
                            'endPrice' => 10000,
                            'validityStart' => date('Y-m-d H:i:s',time()+300),
                            'validityEnd' => date('Y-m-d H:i:s',time()+300000),
                            'StartAtTime' => date('Y-m-d H:i:s',time()),
                            'timerStep' => 300,
                            'priceStep' => 1000,
                            'businessId' => $businessId
                            
                        ),
                        array (
                            'name' => '2 Nights Premium Package',
                            'description' => 'Woohoo',
                            'startPrice' => 20000,
                            'endPrice' => 10000,
                            'validityStart' => date('Y-m-d H:i:s',time()+300),
                            'validityEnd' => date('Y-m-d H:i:s',time()+300000),
                            'StartAtTime' => date('Y-m-d H:i:s',time()+350),
                            'timerStep' => 300,
                            'priceStep' => 1000,
                            'businessId' => $businessId1
                        ),
                        array (
                            'name' => '2 Nights Premium Package',
                            'description' => 'Woohoo',
                            'startPrice' => 20000,
                            'endPrice' => 10000,
                            'validityStart' => date('Y-m-d H:i:s',time()+300),
                            'validityEnd' => date('Y-m-d H:i:s',time()+300000),
                            'StartAtTime' => date('Y-m-d H:i:s',time()+400),
                            'timerStep' => 300,
                            'priceStep' => 1000,
                            'businessId' => $businessId1
                        )
                        
                    );

          $this->db->insert_batch('bidoffer', $data); 
    }

    public function getId($table,$column,$value)
    {
        $this->db->select('id');  
        $this->db->from($table);
        $this->db->where($column,$value);
        $query = $this->db->get();
        $result = (array)$query->row();
        return $result['id'];

    }

    public function add_business()
    {

          $cityId = $this->getId('city','name','Panaji');
          $cityId1 = $this->getId('city','name','Mumbai');

          $data = array( array (
                            'name' => 'Taj Vivanta',
                            'contactPerson' => 'Ajay',
                            'mobile' => 9888888880,
                            'email' => 'ajay@gmail.com',
                            'cityId' => $cityId
                            
                        ),
                        array (
                            'name' => 'Deltin Royale',
                            'contactPerson' => 'Raj',
                            'mobile' => 972345678,
                            'email' => 'raj@gmail.com',
                            'cityId' => $cityId1
                            
                        )
                        
                    );

          $this->db->insert_batch('business', $data); 

          $businessId = $this->getId('business','name','Taj Vivanta');
          $businessId1 = $this->getId('business','name','Deltin Royale');

          $category = $this->getId('category','name','Hotel');
          $category1 = $this->getId('category','name','Restaurant');
          $category2 = $this->getId('category','name','Casino');

          $data = array( 
                         array (
                            'businessId' => $businessId,
                            'categoryId' => $category
                         ),
                        array (
                            'businessId' => $businessId,
                            'categoryId' => $category1
                        ),
                        array (
                            'businessId' => $businessId1,
                            'categoryId' => $category2
                        )
                        
                    );

           $this->db->insert_batch('businesscategory', $data); 

    }


     public function add_category()
    {


      
          $data = array( array (
                            'name' =>  'Restaurant'
                        ),
                        array (
                            'name' =>  'Hotel'
                        ),
                        array (
                            'name' =>  'Casino',
                        )

                    );

           $this->db->insert_batch('category', $data); 

    }
    

    public function add_city()
    {
          $data = array( array (
                            'name' =>  'Panaji',
                            'state' =>  'Goa'
                        ),
                        array (
                            'name' =>  'Mumbai',
                            'state' =>  'Maharashtra'
                        ),
                        array (
                            'name' =>  'Bangalore',
                            'state' =>  'Karnataka'
                        )

                    );

    	   $this->db->insert_batch('city', $data); 
    }

}