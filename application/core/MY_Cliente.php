<?php

abstract class MY_Cliente extends CI_Controller
{
    public $data;
    
    public function __construct()
    {
        parent::__construct();
        
        if(!isset($_REQUEST['login']) and !isset($_REQUEST['senha']) and @$this -> uri -> segments[3] != "login") {
            $this->verificaAcesso();
        }
        $this -> data['saudacao'] = $this ->util-> saudacoes() .
            "<span>" . $this -> session -> userdata('cliente_nome').
            " ". $this -> session -> userdata('cliente_sobre_nome'). "</span>";
    }

    public function verificaAcesso()
    {
        if(!$this-> session->userdata('is_cliente_logado')) {
             redirect("/cliente/index/login");
        }
    }

    public function logon()
    {
        $this->data['title'] = "Entrar";
        $this->load->model("admin/modules/usuario/usuarioDAO","usuario",TRUE);
        $status = $this->usuario->consultaUsuario();
            
        if($status['status']) {
            $this->session->set_userdata(array(
                "is_cliente_logado"     => TRUE,
                "cliente_nome"          =>$status['usuario']->nome,
                "cliente_sobre_nome"    =>$status['usuario']->sobre_nome,
                "id_cliente"            =>$status['usuario']->id_usuario));
        }
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) //requisição ajax
            echo json_encode($status);
        else{            
            switch($status['status']){
                case false:
                    $this->session->set_flashdata('erro', $status['msg']);
                    $this->session->set_flashdata('login', $_REQUEST['login']);
                    redirect("cliente/index/login","refresh");
                break;
                case true:
                    redirect("cliente/index","refresh");    
                break;
                default:
                    redirect("cliente/index/login","refresh");
                break;
            }
        }
    }

    public function logoff()
    {
        $this->session->sess_destroy();
        $this->session->sess_destroy("is_cliente_logado");
        $this->session->sess_destroy("cliente_nome");
        $this->session->sess_destroy("cliente_sobre_nome");
        $this->session->sess_destroy("id_cliente");
        redirect("/");
    }
}
