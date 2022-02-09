<?php
class Usuario extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Usuários";

        //requisição ajax
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/".CONTROLLER."/".CONTROLLER."DAO",'',TRUE);
        $this->load->model("admin/modules/permissao/permissaoDAO",'',TRUE);
        $this -> data['permissoes'] = $this -> permissaoDAO-> consultarTodasPermissoes();
    }

    public function index()
    {
        $this->data[CONTROLLER."s"] = $this->consultar();
        $this->load->view("admin/modules/".CONTROLLER."/".CONTROLLER,$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function novo()
    {
        $this->data['acao'] = "Novo usuário";
        $this->data[CONTROLLER]['isEditar'] = FALSE;
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function editar()
    {
        $this->data['acao'] = "Editar usuário";
        $this->data[CONTROLLER] = $this->conultarInstancia();
        $this->data[CONTROLLER]['isEditar'] = TRUE;
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function deletar()
    {
        if($this->usuarioDAO->deletar())
            $this->session->set_flashdata('msg', 'Usuário removido com sucesso');
        else
            $this->session->set_flashdata('erro', 'Erro ao remover o usuario');
        echo json_encode(true);
    }

    public function conultarInstancia()
    {
        return $this->usuarioDAO->consultarInstancia();
    }

    public function consultar()
    {
        return $this->usuarioDAO->consultar();
    }

    public function valida()
    {
        $this -> form_validation -> set_rules("nome", "Nome", "trim|required");
        $this->form_validation->set_rules("sobre_nome","Sobre nome","trim|required");
        $this->form_validation->set_rules("email","E-mail","trim|required|valid_email");        
        $this->form_validation->set_rules('senha', 'Senha', 'required|matches[senhaconf]|min_length[6]');

        if ($this->form_validation->run() == FALSE) {//Erro na validacao
            if(!isset($this->uri->segments[4])) {
                $this->novo();
            } else {
                $this->editar();
            }
        } else {
            if ((!isset($this->uri->segments[4]) ? $this->usuarioDAO->inserir() : $this->usuarioDAO->editar())) {
                $this->session->set_flashdata('msg', 'Usuário salva com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar usuario');
            }
            
            redirect(CONTROLLER, 'refresh');//Redireciona para a listagem
        }
    }
}
