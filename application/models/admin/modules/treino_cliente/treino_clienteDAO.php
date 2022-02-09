<?php
class Treino_clienteDAO extends CI_Model
{
    protected $_table = "treino_cliente";

    public $nome;
    public $imagem;
    public $id_treino_cliente;
    public $status;

    public function __construct()
    {
        //$this->__construct();
        if($this->input->post()) {
            foreach($this->input->post() as $i=> $post) {
                 $this->$i = $post;//seta a publiciavel
            }
        }

        unset($this->ok);
    }

    public function inserir()
    {
        unset($this->id_treino_cliente, $this->id_banner,$this->titulo);
        $this->nome = $this->input->post('nome');
        $this->imagem = $this->input->post('imagem');
        $this->status = $this->input->post('status');
        return $this -> db -> insert("treino_cliente", $this);
    }

    public function editar()
    {
        $this -> db -> where("id_treino_cliente",$this->id_treino_cliente);
        unset($this->id_treino_cliente,$this->id_banner);
        return $this -> db -> update("treino_cliente", $this);
    }

    public function deletar($id)
    {
        return $this->db->delete("treino_cliente", array("id_"."treino_cliente" =>$id));
    }

    public function editaOrdem($ordem)
    {
        return $this->db->query("UPDATE "."treino_cliente"." set ordem = ordem-1 WHERE ordem > ".$ordem);
    }

    public function consultaInstanciaId($id)
    {
        $this->db->select("*");
        $this->db->from("treino_cliente");
        $this->db->where("id_treino_cliente"." =".$id); 
        return $this->db->get()->result()[0];
    }

    public function sortable($position, $item)
    {
        $this->db->where("id_"."treino_cliente",$item);
        return     $this->db->update("treino_cliente",array("ordem"=>$position+1));
    }

    public function getOrdem()
    {
        $this->db->select(" COUNT(id_treino_cliente) as max ");
        $this->db->from("treino_cliente");
        return $this->db->get()->result()[0]->max+1;
    }

    public function consultar($search = array())
    {
        $this->db->select("*");
        $this->db->from("treino_cliente");
        if(array_key_exists("status", $search))
            $this->db->where("status = ".$search['status']);
        $this->db->order_by("nome");
        return $this->db->get()->result();
    }

    public function consultarInstancia()
    {
        $this->db->select("*");
        $this->db->from("treino_cliente");
        $this->db->where("id_treino_cliente =".$this->uri->segment(4));
        return $this->db->get()->result()[0];
    }
}