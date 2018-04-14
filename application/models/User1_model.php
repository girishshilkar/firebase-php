<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// save ,update all the details of registration form,renew form,upgrade form etc
 class User1_Model extends CI_Model
 {  
    public function __construct()
        {  
            date_default_timezone_set('Asia/Kolkata');
            $this->load->database();
        }

     public function fetch_hotelbid_details($id)
        {       
                //fetch personnel details 
                $this->db->select('*,business.name as business_name,bidoffer.name as bidoffer_name');  
                $this->db->from('bidoffer');
                $this->db->where('bidoffer.status',1);
                $this->db->where('business.status',1);
                $this->db->where('startAttime<',date('Y-m-d H:i:s',time()+0));
                $this->db->where('completed',0);
                $this->db->where('bidoffer.id',$id);
                $this->db->join('business', 'business.id = bidoffer.businessId','inner');
                $query = $this->db->get();
                if ($query->num_rows() > 0) 
                {
                    return $query->row();
                } 
                else 
                {
                    return False;
                }
                                    
    }

    public function fetch_hotelbidding_live()
        {       
                //fetch personnel details 
                $this->db->select('*,business.name as business_name,bidoffer.name as bidoffer_name');  
                $this->db->from('bidoffer');
                $this->db->where('bidoffer.status',1);
                $this->db->where('business.status',1);
                $this->db->where('startAttime<',date('Y-m-d H:i:s',time()+0));
                $this->db->where('completed',0);
                $this->db->join('business', 'business.id = bidoffer.businessId','inner');
                $query = $this->db->get();
                return $query->result_array();
        }

    public function fetch_hotelbidding_upcoming()
        {       
                //fetch personnel details 
                $this->db->select('*,business.name as business_name,bidoffer.name as bidoffer_name');  
                $this->db->from('bidoffer');
                $this->db->where('bidoffer.status',1);
                $this->db->where('business.status',1);
                $this->db->where('startAttime>',date('Y-m-d H:i:s',time()+0));
                $this->db->where('completed',0);
                $this->db->join('business', 'business.id = bidoffer.businessId','inner');
                $query = $this->db->get();
                return $query->result_array();
        }

    public function fetch_grandprize_live()
        {       //fetch personnel details 
                $this->db->select('*');  
                $this->db->from('grandprize');
                $this->db->where('startAttime<',date('Y-m-d H:i:s',time()+0));
                $this->db->where('grandprize.status',1);
                $this->db->where('completed',0);
                $query = $this->db->get();
                return $query->result_array();  
        }

    public function fetch_grandprize_upcoming()
        {       //fetch personnel details 
                $this->db->select('*');  
                $this->db->from('grandprize');
                $this->db->where('startAttime>',date('Y-m-d H:i:s',time()+0));
                $this->db->where('grandprize.status',1);
                $this->db->where('completed',0);
                $query = $this->db->get();
                return $query->result_array();  
        }
    

}