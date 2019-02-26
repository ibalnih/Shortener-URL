<?php
class Inputurl extends CI_Model{
    public function __construct()
    {
        // $this->load->database();
        // $this->load->helper('url');
    }

    // public function index()
    // {
        
    // }
    // public function addUrl($longUrl, $shortUrl){
    //     $data = array(
    //         'long_url' => $longUrl,
    //         'short_urls' => $shortUrl,
    //     );
    //     $this->db->insert('shorten', $data);
    // }

    // public function getUrl($url)
    // {
    //     $urldt = $this->db->get_where('shorten', array('long_url' => $url));
        
    //     return $urldt->result_array();
    // }


    // Shorten Link
    public function addUrlEM($data){
        $this->db->insert('short', $data);
    }

    public function checkEM($url)
    {
        $query = $this->db->get_where('short', array('url' => $url));
        return $query->result_array();
    }

    public function checkCustom($redirect)
    {
        $query = $this->db->get_where('short', array('redirect' => $redirect));
        return $query->result_array();
    }
    //End Shorten Link
    
}