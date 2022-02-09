<?php
class ClienteDAO extends CI_Model
{
    public $nome;
    public $sobre_nome;
    public $email;    
    public $senha;
    public $id_permissao;
    public $id_usuario;
    public $foto;
    public $senhaconf;
    public $acesso_cliente;

    public function __construct()
    {
        parent::__construct();
        
        if($this->input->post()) {
            //foreach dos posts
            foreach($this->input->post() as $i=> $post) {
                //seta a publiciavel
                $this->$i = $post;
            }
        }

        unset($this->senhaconf);
        unset($this->ok);
    }

    public function inserir()
    {
        //Deleta a instancia de id_usuario par anão atrapalhar no inserção ou criar um array
        unset($this->id_usuario);
        unset($this->foto);
        $this->senha = md5($this->input->post("senha"));

        //inserir na tabela permissao
        $this->db->insert("cliente",$this);
        return $this->db->insert_id();
    }

    public function editar()
    {
        $this -> senha = md5($this->input->post("senha"));
        $this -> db -> where("id_usuario",$this->id_usuario);
        
        //inserir na tabela permissao
        return $this -> db -> update("usuario", $this);
    }

    public function deletar()
    {
        return $this->db->delete("cliente",array(
            "id_usuario"=> (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));
    }

    public function consultar()
    {
        $this->db->select("*, permissao.nome as permissao_nome, usuario.nome as usuario_nome ");
        $this->db->from("cliente");
        $this->db->join("permissao", "permissao.id_permissao = usuario.id_permissao","left");
        $query = $this->db->get();
        return $query->result();
    }

    public function consultarInstancia()
    {
        $this->db->select('*');
        $this->db->from("usuario");
        $this->db->where("id_usuario = ". (isset($_POST['id_usuario']) ? $_POST['id_usuario'] :  $this->uri->segment(4)));
        $query = $this->db->get();
        return $query->result();
    }

    public function consultaInstanciaTipoPermissao($id_usuario)
    {
        $this->db->select('*, usuario.nome as cliente_nome');
        $this->db->from("usuario");
        $this->db->where("id_usuario = ".$id_usuario );
        $this->db->join("permissao", "permissao.id_permissao = usuario.id_permissao");
        $query = $this->db->get();
        return $query->result();
    }

    public function consultaUsuario()
    {
        $this->db->select('*');
        $this->db->from("usuario");
        $this->db->where("email = '".(isset($_POST['login']) ? $_POST['login'] :  $this->uri->segment(4)) ."'");
        $query = $this->db->get();

        if (count($query->result())) {
            if ($this->input->post()['isCliene']) {
                if(!$query->result()[0]->acesso_cliente or empty($query->result()[0]->acesso_cliente)) {
                    return array("status"=>false,"msg"=>"Usuário bloqueado.");
                }
            } else {
                if($query->result()[0]->id_permissao == 0 or empty($query->result()[0]->id_permissao)) {
                    return array("status"=>false,"msg"=>"Usuário bloqueado pelo administrador!");
                }
            }

            if ($query->result()[0]->senha == md5($_POST['senha'])) {
                @session_start();
                @session_destroy();
                return array("status"=>true,"usuario"=>$query->result()[0]);
            } else {
                return array("status"=>false,"msg"=>"Ops! Senha incorreta.");
            }
        } else {
            return array("status"=>false,"msg"=>"Ops! Login incorreta.");
        }
        return $query->result();
    }

    public function consultaUsuarioPermissao($id_usuario)
    {
        $this->db->select("*, permissao.nome as permissao_nome, usuario.nome as usuario_nome ");
        $this->db->from("usuario");
        $this->db->join("permissao", "permissao.id_permissao = usuario.id_permissao");
        $this->db->join("permissao_modulo", "permissao.id_permissao = permissao_modulo.id_permissao");
        $this->db->where("usuario.id_usuario = ".$id_usuario." ");
        $query = $this->db->get();
        return $query->result();
    }
}