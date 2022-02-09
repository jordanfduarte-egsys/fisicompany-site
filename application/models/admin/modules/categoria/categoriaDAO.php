<?php

class CategoriaDAO extends CI_Model
{
    public $data;

    public function __construct()
    {
        parent::__construct();
    }
    
    public function consultar()
    {
        return $this->db->select("*")->from("categoria")->get()->result();
    }
}
