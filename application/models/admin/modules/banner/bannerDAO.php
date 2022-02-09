<?php
class BannerDAO extends CI_Model
{
    protected $_table = "banner";
    
    public $titulo;
    public $link;
    public $imagem;
    public $ordem;
    public $id_banner;
    public $status;

    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        if($this->input->post()) {
            //foreach dos posts
            foreach($this->input->post() as $i=> $post) {
                 $this->$i = $post;//seta a variavel
            }
        }
        unset($this->ok);
    }

    public function inserir()
    {
        $this->titulo = $this->input->post('titulo');
        $this->link = $this->input->post('link');
        $this->imagem = $this->input->post('imagem');
        $this->ordem = $this->getOrdem();
        $this->status = $this->input->post('status');
        
        //inserir na tabela permissao
        return $this->db->insert('banner', $this);
    }

    public function editar()
    {
        $this->db->where("id_banner",$this->id_banner);
        return $this->db->update('banner', $this);
    }

    public function deletar($id)
    {
        return $this->db->delete($this->_table, array("id_".$this->_table=>$id));
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
        $this->db->select(" COUNT(id_banner) as max ");
        $this->db->from("banner");
        return $this->db->get()->result()[0]->max+1;
    }

    public function consultar()
    {
        $this->db->select("*");
        $this->db->from("banner");
        $this->db->order_by("ordem");
        return $this->db->get()->result();
    }

    public function consultarInstancia()
    {
        $this->db->select("*");
        $this->db->from("banner");
        $this->db->where("id_banner =".$this->uri->segment(4));
        return $this->db->get()->result()[0];
    }
}