<?php
class GaleriaDAO extends CI_Model
{
    protected $_table = "galeria";

    public $nome;
    public $imagem_principal;
    public $id_galeria;
    public $texto;
    public $status;

    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        parent::__construct();
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
        unset($this->id_noticia);

        //inserir na tabela permissao
        $this -> db -> insert($this->_table, $this);
        $idgaleria = $this->db->insert_id();

        if ($idgaleria) {
            foreach($this->input->post("imagem") as $imagem) {
                $this->db->insert($this->_table."_imagem", array(
                    "id_galeria"=>$idgaleria,
                    "imagem"=>$imagem
                ));
            }
        }

        return $idgaleria;
    }

    public function editar()
    {
         $this->db->delete($this->_table."_imagem",array("id_".$this->_table=> $this->id_galeria));
         foreach($this->input->post("imagem") as $imagem) {
            $this->db->insert($this->_table."_imagem",array(
                "id_galeria"=>$this->id_galeria,
                "imagem"=>$imagem
            ));
         } 

         $this -> db -> where("id_".$this->_table,$this->id_galeria);
         return $this -> db -> update($this->_table, $this);
    }
    
    public function deletar()
    {
        $this->db->delete($this->_table."_imagem",array("id_".$this->_table=> (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));
        return $this->db->delete($this->_table ,array("id_".$this->_table=>(isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));

    }

    public function getOrdem()
    {
        $this->db->select(" COUNT(id_".$this->_table.") as max ");
        $this->db->from($this->_table);
        return $this->db->get()->result()[0]->max+1;
    }

    public function consultar($dados = array())
    {
        $this->db->select("*");
        $this->db->from("galeria");
        if (array_key_exists("limit", $dados)) {
            return $this->db->get("",$dados['limit'])->result();
        } else {
            return $this->db->get()->result();
        }
    }

    public function consultarInstancia($dados = array())
    {
        $this->db->select("*");
        $this->db->from("galeria");
        $this->db->join("galeria_imagem", "galeria_imagem.id_galeria = galeria.id_galeria");
        if (array_key_exists("id_galeria", $dados)) {
            $this->db->where("galeria.id_galeria =".$dados['id_galeria']);
        } else {
            $this->db->where("galeria.id_galeria =".$this->uri->segment(4));
        }
        
        return $this->db->get()->result();
    }

    public function get_all_posts($limit, $start)
    {
         $this->db->limit($limit, $start);
         $query = $this->db->get('galeria');
         return $query->result();
    }

    public function count_posts()
    {
      return $this->db->count_all('galeria');
    }
}