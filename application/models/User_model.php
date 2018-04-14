<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/12/2018
 * Time: 2:30 PM
 */
class User_model extends CI_Model
{

    public function user_signup()
    {
        $count = $this->db->get_where('users', array('email' => $this->input->post('email')));
        if ($count->num_rows() > 0) {
            return false;
        } else {

            $data = array(
                'firstName' => $this->input->post('fname'),
                'lastName' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'mobile' => $this->input->post('phone'),
                'bonusPoints' => 0,
                'scratchesFree' => 0,
                'scratchesBought' => 0
            );

            $this->db->insert('users', $data);
            return $this->db->insert_id();

        }
    }

    public function user_login()
    {
        $this->db->select('id, firstName, lastName, email, mobile, bonusPoints, scratchesFree, scratchesBought, lastloginDatetime');
        $this->db->from('users');
        $this->db->where(array('email' => $this->input->post('email'), 'password' => md5($this->input->post('password')), 'status' => 1));

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_user_info()
    {
        $query = $this->db->get_where('users', array('id' => $this->input->get('user_id')));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

}