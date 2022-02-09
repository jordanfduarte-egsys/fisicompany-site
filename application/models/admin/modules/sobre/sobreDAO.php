<?php
class SobreDAO extends CI_Model
{
    protected $_table = "sobre";

    public $nome;
    public $status;
    public $imagem;
    public $id_sobre;

    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        parent::__construct();

        if($this->input->post()) {
            foreach($this->input->post() as $i=> $post) {
                 $this->$i = $post;
            }
        }

        unset($this->ok);
    }

    public function inserir()
    {
        unset($this->id_sobre);
        return $this -> db -> insert($this->_table, $this);
    }

    public function editar()
    {
        $this -> db -> where("id_".$this->_table,$this->id_sobre);
        return $this -> db -> update($this->_table, $this);
    }

    public function deletar()
    {
        return $this->db->delete($this->_table ,array("id_".$this->_table=>(isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));

    }

    public function getOrdem()
    {
        $this->db->select(" COUNT(id_".$this->_table.") as max ");
        $this->db->from($this->_table);
        return $this->db->get()->result()[0]->max+1;
    }

    public function consultar()
    {
        $this->db->select("*");
        $this->db->from("sobre");
        return $this->db->get()->result();
    }

    public function consultarInstancia()
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("id_".$this->_table." =".$this->uri->segment(4)); 
        return $this->db->get()->result()[0];
    }
}