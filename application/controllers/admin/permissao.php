<?php
class Permissao extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Permissão";

        //requisição ajax
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/".CONTROLLER."/".CONTROLLER."DAO",'model',TRUE);
    }
    
    public function index()
    {
        $this->data['permissoes'] = $this->consultar();
        $this->load->view("admin/modules/".CONTROLLER."/".CONTROLLER,$this->data);
        $this->load->view("admin/abstract/footer");    
    }

    public function novo()
    {
        $this->data['acao'] = "Nova permissão";
        $this->data[CONTROLLER]['modulos'] = $this->config->config['controllers'];
        $this->data[CONTROLLER]['isEditar'] = FALSE;        
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
        
    }

    public function editar()
    {
        
        $this->data[CONTROLLER] = $this->conultarInstancia();
        $this->data[CONTROLLER]['modulos'] = $this->config->config['controllers'];
        $this->data[CONTROLLER]['isEditar'] = TRUE;
        $this->data['acao'] = "Editar permissão";        
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function deletar()
    {
        if ($this->model->deletar()) {
            $this->session->set_flashdata('msg', 'Permissão removido com sucesso');
        } else {
            $this->session->set_flashdata('erro', 'Erro ao remover a permissão.');
        }

        echo json_encode(true);
    }

    public function conultarInstancia()
    {
        return $this->model->consultarInstancia();
    }

    public function consultar()
    {
        return $this->model->consultar();
    }

    public function valida()
    {
        $this->form_validation->set_rules("nome","Nome","trim|required");

        if($this->form_validation->run() == FALSE){//Erro na validacao
            if (!isset($this->uri->segments[4])) {
                $this->novo();
            } else {
                $this->editar();
            }
        } else {
            if ((!isset($this->uri->segments[4]) ? $this->model->inserir() : $this->model->editar())) {
                $this->session->set_flashdata('msg', 'Permissão salva com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar permissão');
            }
            
            redirect(CONTROLLER, 'refresh');//Redireciona para a listagem
        }
    }

    public function consultarTodasPermissoes()
    {
        return $this->permissaoDAO->consultarTodasPermissoes();
    }
}
