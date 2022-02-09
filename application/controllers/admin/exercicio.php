<?php
class exercicio extends MY_Controller
{
    public function __construct()
    {        //intancia da base
        parent::__construct();
    
        $this->data['title'] = "Exercicios";
        
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/".CONTROLLER."/".CONTROLLER."DAO",'model',TRUE);
        $this->load->model("admin/modules/categoria/categoriaDAO",'categoria',TRUE);
        $this->data['categorias'] = $this->categoria->consultar();
        
    }
    public function index()
    {
        $this->data['exercicios'] = $this->consultar();        
        $this->load->view("admin/modules/".CONTROLLER."/".CONTROLLER,$this->data);
        $this->load->view("admin/abstract/footer");
    }
    public function novo(){        
        $this->data['acao'] = "Novo exercicio";        
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }    
    public function editar(){
        $this->data['exercicio'] = $this->conultarInstancia();        
        $this->data['acao'] = "Editar exercicio";        
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    public function deletar(){        
        $id = (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(3));
        $ordem = $this->model->consultaInstanciaId($id);
                
        if($this->model->deletar($id)){
            $this->model->editaOrdem($ordem->ordem);            
            $this->session->set_flashdata('msg', 'Exercicio removido com sucesso');            
        }else
            $this->session->set_flashdata('erro', 'Erro ao remover o exercicio.');
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
    public function valida(){
        //Validação de inserção e editar.
        //Só mudar o nome da controller e os campos de validação abaixo    
        $this->form_validation->set_rules("nome","Nome","trim|required");
        //$this->form_validation->set_rules("descricao","Descrição","trim|required");
        //$this->form_validation->set_rules("imagem","Imagem","trim|required");
        $this->form_validation->set_rules("id_categoria","Categoria","trim|required");                        
        if($this->form_validation->run() == FALSE){//Erro na validacao
            if(!isset($this->uri->segments[4]))
                $this->novo();
            else            
                $this->editar();
        }else
        {
                        
            if((!isset($this->uri->segments[4]) ? $this->model->inserir() : $this->model->editar()))
                $this->session->set_flashdata('msg', 'Exercicio salva com sucesso');
            else
                $this->session->set_flashdata('erro', 'Erro ao salvar a exercicio');
            
            redirect(CONTROLLER, 'refresh');//Redireciona para a listagem
        }
        
    }
}
