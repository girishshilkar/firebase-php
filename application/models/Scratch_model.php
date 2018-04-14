<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/13/2018
 * Time: 9:59 AM
 */
class Scratch_model extends CI_Model
{
    public function scratch_business_list()
    {
//        $this->db->distinct();
//        $this->db->select('*');
//        $this->db->from('business');
//        $this->db->join('scratchoffer', 'scratchoffer.businessId = business.id');
//        $this->db->where(array('business.status' => 1, 'scratchoffer.status' => 1, 'scratchoffer.startDate >' => NOW(), FALSE ));
        $query = $this->db->query("SELECT DISTINCT b.* FROM business b
                                    INNER JOIN scratchoffer so ON so.businessId = b.id
                                    WHERE b.status = 1 and so.status = 1 and so.startDate >= NOW()");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function scratch_prodcuts_list($business_id)
    {
        $query = $this->db->query("SELECT DISTINCT so.*,b.name businessName FROM business b
                                    INNER JOIN scratchoffer so ON so.businessId = b.id
                                    WHERE so.businessId = ".$this->db->escape($business_id)." and so.useLimit > 0 and b.status = 1 and so.status = 1 and so.startDate >= NOW()");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function scratch_now($business_id)
    {
        $query = $this->db->query("SELECT DISTINCT so.id, so.description FROM scratchoffer so
                                    INNER JOIN business b ON so.businessId = b.id
                                    WHERE so.businessId = ".$this->db->escape($business_id)." and so.useLimit > 0 and b.status = 1 and so.status = 1 and so.startDate >= NOW()");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
