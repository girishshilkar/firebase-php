<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scratch extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
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
    }

    public function businessList()
    {
        $res = file_get_contents(base_url() . 'api/scratch/scratch_business_list');

        $this->load->view('user/common/header');
        $this->load->view('user/scratch/scratch_business', array('business_list' => json_decode($res)));
        $this->load->view('user/common/footer');
    }

    public function scratchPage()
    {
        $res = file_get_contents(base_url() . 'api/scratch/scratch_products?id='.$this->input->get('id'));

        $this->load->view('user/common/header');
        $this->load->view('user/scratch/scratch_page', array('scratch_products' => json_decode($res)));
        $this->load->view('user/common/footer');
    }

    public function scratchIt()
    {
        $url = $url = base_url('api/Scratch/scratch_now');
        $res = postCURL($url, $this->input->post(), 'POST');

        echo json_encode($res);
    }
}