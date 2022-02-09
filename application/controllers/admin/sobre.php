<?php
class Sobre extends MY_Controller{
    
    public function __construct()
    {        //intancia da base
        parent::__construct();
    
        $this->data['title'] = "Sobre";
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/".CONTROLLER."/".CONTROLLER."DAO",'model',TRUE);
    }

    public function index()
    {
        $this->data['sobres'] = $this->consultar();
        $this->load->view("admin/modules/".CONTROLLER."/".CONTROLLER,$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function novo()
    {
        $this->data['acao'] = "Nova estrutura";
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function editar()
    {
        $this->data['sobre'] = $this->conultarInstancia();
        $this->data['acao'] = "Editar sobre";
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function deletar()
    {
        if ($this->model->deletar()) {
            $this->session->set_flashdata('msg', 'Sobre removido com sucesso');
        } else {
            $this->session->set_flashdata('erro', 'Erro ao remover sobre.');
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
        //Validação de inserção e editar.
        //Só mudar o nome da controller e os campos de validação abaixo    
        $this->form_validation->set_rules("nome","Nome","trim|required");
        $this->form_validation->set_rules("imagem","Imagem","trim|required");
        if ($this->form_validation->run() == FALSE) {//Erro na validacao
            if (!isset($this->uri->segments[4])) {
                $this->novo();
            } else {
                $this->editar();
            }
        } else {
            if ((!isset($this->uri->segments[4]) ? $this->model->inserir() : $this->model->editar())) {
                $this->session->set_flashdata('msg', 'Sobre salva com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar sobre');
            }
            
            redirect(CONTROLLER, 'refresh'); //Redireciona para a listagem
        }
    }
}
