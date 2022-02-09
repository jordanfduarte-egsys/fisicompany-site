<?php
class EstruturaDAO extends CI_Model
{
    protected $_table = "estrutura";
    
    public $nome;
    public $texto;
    public $status;
    public $imagem;
    public $ordem;
    public $id_estrutura;
    
    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        if ($this->input->post()) {
            //foreach dos posts
            foreach($this->input->post() as $i=> $post) {
                //seta a publiciavel
                $this->$i = $post;
            }
        }
        
        unset($this->ok);
    }

    public function inserir()
    {
        $this->ordem = $this->getOrdem();
        unset($id_estrutura);
        
        //inserir na tabela permissao
        return $this -> db -> insert($this->_table, $this);
    }

    public function editar()
    {
        $this -> db -> where("id_".$this->_table,$this->id_estrutura);
        return $this -> db -> update($this->_table, $this);
    }

    public function deletar($id)
    {
        return $this->db->delete($this->_table,array("id_".$this->_table=> $id));
    }

    public function editaOrdem($ordem)
    {
        return $this->db->query("UPDATE ".$this->_table." set ordem = ordem-1 WHERE ordem > ".$ordem);
    }

    public function consultaInstanciaId($id)
    {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("id_".$this->_table." =".$id); 
        return $this->db->get()->result()[0];
    }

    public function sortable($position, $item)
    {
        $this->db->where("id_".$this->_table,$item);
        return $this->db->update($this->_table,array("ordem"=>$position+1));
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
        $this->db->from("estrutura");
        $this->db->order_by("ordem");
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