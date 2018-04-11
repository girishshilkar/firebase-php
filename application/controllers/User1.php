<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() 

	{
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
    }

	public function home()
	{


		$this->load->view('user/common/header');
        $this->load->view('user/home');
        $this->load->view('user/common/footer');
	}


	public function hotelbidding()
	{
		
		$result = file_get_contents(base_url() . 'api/main_page/hotelbidding');
		$list = json_decode($result);
		$data = array('list' => $list);
		#print_r($list);
		$this->load->view('user/common/header');
		$this->load->view('user/common/menu');
		$this->load->view('user/common/breadcrumbs');
        $this->load->view('user/hotel_bidding/home',$data);
        $this->load->view('user/common/footer');
	}

	public function grandPrize()
	{

		$result = file_get_contents(base_url() . 'api/main_page/firebase');
		#$homepage = var_dump($homepage);
		
		$list = json_decode($result);
		#print_r($ss);

		foreach($list as $key1=>$value1) 
		{ //foreach element in $arr
		    print_r($key1);
		    echo '</br>';
		    foreach($value1 as $key2=>$value2) 
		    {
		    	print_r($key2);
		    	print_r($value2);
		    	echo '</br>';
		    }
		    echo '</br></br></br>';
		}


		$this->load->view('user/common/header');
        $this->load->view('user/grand_prize/home');
        $this->load->view('user/common/footer');
	}

	public function trial_pp()
	{
		$params = array(
			
           "name" => 'sss',
           "email" => 'ddd',
           "password" =>'bbb'
        );
		$url = base_url() . 'api/main_page/trial';

		echo '<br><hr><h2>'.$this->postCURL($url, $params).'</h2><br><hr><br>';
		
	}

	public function postCURL($_url, $_param)
	{

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }


}
