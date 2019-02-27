<?php
class Inputurl extends CI_Model{
    public function __construct()
    {
        // $this->load->database();
        // $this->load->helper('url');
    }

    // Shorten Link
    public function addUrlEM($data){
        $this->db->insert('short', $data);
    }

    public function checkEM($url)
    {
        $query = $this->db->get_where('short', array('url' => $url));
        if($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkCustom($redirect)
    {
        $query = $this->db->get_where('short', array('redirect' => $redirect));
        return $query->result_array();
    }
    
    public function getUrl($url)
    {
        $query = $this->db->where(array('redirect' => $url))->get('short');
        if($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    //End Shorten Link
}