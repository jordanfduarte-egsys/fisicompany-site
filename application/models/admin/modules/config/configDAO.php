<?php
class ConfigDAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function consultar()
    {
        $this->db->select("*");
        $this->db->from("config");
        $query = $this->db->get();
        
        return $query->result_array();
    }
}