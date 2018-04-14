<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Grandprize extends CI_Controller {

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

	public function index()
	{

		$result = file_get_contents(base_url() . 'api/grandprize/grandprize_live');
		$result = (array)json_decode($result);
		$live = $result['data'];

		$result = file_get_contents(base_url() . 'api/grandprize/grandprize_upcoming');
		$result = (array)json_decode($result);
		$upcoming = $result['data'];

		$data = array(	'live' => $live,
						'upcoming' => $upcoming);

		$this->load->view('user/common/header');
		$this->load->view('user/common/menu');
		$this->load->view('user/common/breadcrumbs');
        $this->load->view('user/grand_prize/home',$data);
        $this->load->view('user/common/footer');
	}


}
