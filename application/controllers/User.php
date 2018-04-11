<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
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

    public function signup()
    {
        if ($_POST) {
            $url = API_URL . 'Userlogin/signup';
            $res = postCURL($url, $this->input->post(), 'POST');
        }
        $this->load->view('user/common/header');
        $this->load->view('user/login/signup');
        $this->load->view('user/common/footer');
    }

    public function login()
    {
        if ($_POST) {
            $url = $url = base_url('api/Userlogin/login');
            $res = postCURL($url, $this->input->post(), 'POST');
            if ($res->status == 1) {
                redirect('user/home');
            } else {
                $this->session->set_flashdata('error', 'Invalid credentials');
            }
        }

        $this->load->view('user/common/header');
        $this->load->view('user/login/login');
        $this->load->view('user/common/footer');
    }

    public function home()
    {
        $this->load->view('user/home');
    }

}