<?php
class estrutura extends MY_Controller
{

    public function __construct()
    {        //intancia da base
        parent::__construct();
    
        $this->data['title'] = "Estrutura";
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/".CONTROLLER."/".CONTROLLER."DAO",'model',TRUE);
        
    }
    public function index()
    {
        $this->data['estruturas'] = $this->consultar();        
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
        $this->data['estrutura'] = $this->conultarInstancia();        
        $this->data['acao'] = "Editar estrutura";        
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    public function deletar()
    {        
        $id = (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(3));
        $ordem = $this->model->consultaInstanciaId($id);
                
        if($this->model->deletar($id)){
            $this->model->editaOrdem($ordem->ordem);            
            $this->session->set_flashdata('msg', 'Estrutura removido com sucesso');            
        }else
            $this->session->set_flashdata('erro', 'Erro ao remover a estrutura.');
        echo json_encode(true);
    
    }
    public function sortable()
    {    $sql = array();
        $params = array();
                parse_str($_POST['order'], $params);
        foreach ($params['listItem'] as $position => $item) :
             $this->model->sortable($position, $item);            
        endforeach;
        echo json_encode(array("status"=>true));        
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
        $this->form_validation->set_rules("texto","Texto","trim|required");
        $this->form_validation->set_rules("imagem","Imagem","trim|required");                        
        if($this->form_validation->run() == FALSE){//Erro na validacao
            if(!isset($this->uri->segments[4]))
                $this->novo();
            else            
                $this->editar();
        }else
        {
                        
            if((!isset($this->uri->segments[4]) ? $this->model->inserir() : $this->model->editar()))
                $this->session->set_flashdata('msg', 'Estrutura salva com sucesso');
            else
                $this->session->set_flashdata('erro', 'Erro ao salvar a estrutura');
            
            redirect(CONTROLLER, 'refresh');//Redireciona para a listagem
        }
        
    }
}
