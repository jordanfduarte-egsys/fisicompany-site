<?php
class Perfil extends MY_Controller
{
    public function __construct()
    {    //intancia da base
        parent::__construct();    
        $this->data['title'] = "Perfil";
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/usuario/usuarioDAO",'model',TRUE);
        
    }
    
    public function index()
    {
    
        $this->data['usuario'] = $this->data["usuario_loagado"];
        $this->data['usuario']->tipo_permissao = $this->model->consultaInstanciaTipoPermissao($this->data["usuario"]->id_usuario);
        $this->data["usuario"]->banco = $this->data['usuario']->tipo_permissao[0];
        $this->data["usuario"]->tipo_permissao = $this->data['usuario']->tipo_permissao[0]->nome;
        $this->data['action'] = CONTROLLER."/valida/".$this->data['usuario']->id_usuario;
        $this->data['acao'] = "Perfil";
        $this->data[CONTROLLER] = $this->consultar();
        $this->load->view("admin/pagina/".CONTROLLER, $this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function novo(){}
    public function editar(){}
    public function deletar(){}
    public function consultar(){}
    
    public function conultarInstancia(){
        return $this->model->consultarInstancia();
    }
    public function valida()
    {
        //Validação de inserção e editar.
        //Só mudar o nome da controller e os campos de validação abaixo    
        $this->form_validation->set_rules("nome", "Nome", "trim|required");
        $this->form_validation->set_rules("sobre_nome","Sobre nome","trim|required");
        $this->form_validation->set_rules("email","E-mail","trim|required|valid_email");
        $this->form_validation->set_rules('senha', 'Senha', 'required|matches[senhaconf]|min_length[6]');
                    
        if ($this->form_validation->run() == FALSE) {//Erro na validacao
            $this->index();
        } else {
            if((!isset($this->uri->segments[3]) ? $this->model->inserir() : $this->model->editar())) {
                //Atualiza os dados da sessão
                $this->session->userdata['dados_usuario_logado'] = $this->model->consultarInstancia()[0];
                $this->session->set_flashdata('msg', 'Configuração salva');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar as configurações');
            }
            
            redirect(CONTROLLER, 'refresh');//Redireciona para a listagem
        }
    }
}
