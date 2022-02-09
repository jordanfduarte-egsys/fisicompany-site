<?php
class PermissaoDAO extends CI_Model
{
    
    protected $_table = "permissao";

    public $nome = '';
    public $id_permissao = '';
    public $permissao_modulo = '';

    public function __construct()
    {
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
        unset($this->id_permissao);
        
        $this -> db -> insert($this->_table, $this);
        $this -> id_permissao = $this->db->insert_id();
        return $this->inserirPermissao();
    }

    public function editar()
    {
        $this -> db -> where("id_".$this->_table,$this->id_permissao);
        $this -> db -> update($this->_table, array("nome"=>$this->nome));
        return $this->inserirPermissao();
    }

    public function inserirPermissao()
    {
        try {
            $this->db->delete($this->_table."_modulo",array("id_".$this->_table=>$this->id_permissao));
            foreach($this->permissao_modulo as $modulo) {
                $permissao_modulo = array("id_".$this->_table=>$this->id_permissao, "nome"=> $modulo);
                $this -> db -> insert($this->_table.'_modulo', $permissao_modulo);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function consultar()
    {
        $this->db->select('*,permissao.nome as permissao_nome,  permissao_modulo.nome as permissao_modulo_nome');
        $this->db->from('permissao');
        $this->db->join('permissao_modulo', 'permissao_modulo.id_permissao = permissao.id_permissao'); 
        $query = $this->db->get();
        return $query->result();
    }

    public function consultarInstancia()
    {
        $this->db->select('*, permissao.nome as permissao_nome,  permissao_modulo.nome as permissao_modulo_nome');
        $this->db->from('permissao');
        $this->db->join('permissao_modulo', 'permissao_modulo.id_permissao = permissao.id_permissao'); 
        $this->db->where("permissao.id_permissao =".(isset($_POST['id_permissao']) ? $_POST['id_permissao'] :  $this->uri->segment(4)) );
        $query = $this->db->get();

        return $query->result();
    }

    public function deletar()
    {
         $this->db->delete("permissao",array("id_permissao"=>(isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));
         return $this->db->delete("permissao_modulo",array("id_permissao"=>(isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));
    }

    public function consultarTodasPermissoes()
    {
        $this->db->select('*');
        $this->db->from('permissao');
        $query = $this->db->get();
        return $query->result();
    }
}