<?php

class login extends MY_Controller{
    public $data = array();
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        parent::__construct();
        if($this->session->userdata('isLogado') or $this->input->cookie("isLogado")) {
            redirect("/home/","refresh");
        }

        $this->data['title'] = "Login Admin";
        $this->load->view("admin/abstract/header", $this->data);
        $this->load->view("admin/modules/login/login");
    }
    
    public function logon()
    {
        $this->load->model("admin/modules/usuario/usuarioDAO","",TRUE);
        $status = $this->usuarioDAO->consultaUsuario();
        if($status['status']){
            $arrLogon = array(
                "isLogado"=>true,
                "dados_usuario_logado"=>$status['usuario']);
                        
            foreach($this->usuarioDAO->consultaUsuarioPermissao($arrLogon['dados_usuario_logado']->id_usuario) as $permissao) {
//                 if(preg_match("/::/", $permissao->nome)) {
//                     continue;
//                 }
                
                $arrLogon['permissao_modulo'][] = $permissao->nome;
            }
            $this->session->set_userdata($arrLogon);
                    
            //lembrar
            if(isset($_POST['lembrar']) and $_POST['lembrar']){
                $cookie = array(
                   'name'   => 'isLogado',
                   'value'  => 'true',
                   'expire' => '15000000',
                   'prefix' => ''
                );
                $this->input->set_cookie($cookie);
            }
            
            redirect("home","redirect");
        } else {
            $this->session->set_flashdata('msg', $status['msg']);
            $this->index();
        
        }
    }
    
    public function logoff()
    {
        $this->session->sess_destroy();
        delete_cookie("isLogado");
        $this->index();
    }
    
    public function novo(){}//pagina novo
    public function editar(){}//pagina editar
    public function deletar(){}//apresenta modal deletar com os dados
    public function valida(){}//valida novo e grava
    public function conultarInstancia(){}//Consulta um registro com post ou get
    public function consultar(){}
}
