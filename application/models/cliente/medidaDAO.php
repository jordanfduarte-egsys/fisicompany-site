<?php
class MedidaDAO extends CI_Model
{
    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        parent::__construct();
    }

    public function consultar($data)
    {
        return $this->db->select("*, DATE_FORMAT(data, ('%d/%m/%Y')) as data_br")
            ->from("medida")
            ->where("id_usuario",$data['id_usuario'])
            ->order_by("data","desc")
            ->get()
            ->result();
    }

    public function consultarMes($data)
    {
        $data['data'] = explode("/",$data['data']);
        $data['data'] = $data['data'][1]."-".$data['data'][0];
    
        return $this->db->select("*, DATE_FORMAT(data, ('%d/%m/%Y')) as data_br")
            ->from("medida")
            ->where("id_usuario",$data['id_usuario'])
            ->where("data LIKE '%".$data['data']."%' ")
            ->get()
            ->result();
    }

    public function consultaMax($data)
    {
        return $this->db->select("*, MAX(id_medida), DATE_FORMAT(data, ('%d/%m/%Y')) as data_br")
            ->from("medida")
            ->where("id_usuario",$data['id_usuario'])
            ->get()
            ->result();
    }
}
