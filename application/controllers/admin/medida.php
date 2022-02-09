<?php
class Medida extends MY_Controller
{
    public $args = array();
    
    public function __construct()
    {        
        // intancia da base    
        parent::__construct();
        $this->data['title'] = "Medida";
        
        //requisição ajax
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/".CONTROLLER."/".CONTROLLER."DAO",'model',TRUE);
        $this->load->model("admin/modules/usuario/usuarioDAO","usuarioDAO",TRUE);
    }
    
    public function index()
    {
        $this->data['cliente'] = $this->usuarioDAO->consultarInstancia();
        if(count($this->data['cliente'])) {
            $this->data['cliente'] = $this->data['cliente'][0];
        }
        
        $this->args = Array("id_cliente"=>$this -> uri -> segments[4]);
        $this->data['medidas'] = $this->consultar();
        $this->load->view("admin/modules/".CONTROLLER."/".CONTROLLER,$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function novo()
    {
        $this->data['medida'] = $this->usuarioDAO->consultarInstancia();
        if(count($this->data['medida'])) {
            $this->data['medida'] = $this->data['medida'][0];
        }
        $this->data['acao'] = "Nova medida";
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function editar()
    {
        $this->args = Array("id_cliente"=>$this -> uri -> segments[5]);
        $this->data['medida'] = $this->conultarInstancia();
        $this->data['acao'] = "Editar medida";
        $this->data['action'] = "medida/valida/".$this -> uri -> segments[4]."/".$this -> uri -> segments[5];
        $this->load->view("admin/modules/".CONTROLLER."/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function deletar()
    {
        $id = (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(3));
        $ordem = $this->model->consultaInstanciaId($id);
                
        if ($this->model->deletar($id)){
            $this->session->set_flashdata('msg', 'Medida removido com sucesso');
        } else {
            $this->session->set_flashdata('erro', 'Erro ao remover a medida.');
        }
        
        echo json_encode(true);
    }

    public function sortable()
    { 
        $sql = array();
        $params = array();
        parse_str($_POST['order'], $params);

        foreach ($params['listItem'] as $position => $item) :
             $this->model->sortable($position, $item);
        endforeach;
        echo json_encode(array("status"=>true));
    }

    public function conultarInstancia()
    {
        return $this->model->consultarInstancia($this->args);
    }

    public function consultar()
    {
        return $this->model->consultar($this->args);
    }

    public function valida(){
        //Validação de inserção e editar.
        //Só mudar o nome da controller e os campos de validação abaixo    
        $this->form_validation->set_rules("braco","Braco","trim|required");
        $this->form_validation->set_rules("antebraco","Antebraço","trim|required");
        $this->form_validation->set_rules("peitoral","Peitoral","trim|required");
        $this->form_validation->set_rules("cintura","Cintura","trim|required");
        $this->form_validation->set_rules("abdomen","Andomen","trim|required");
        $this->form_validation->set_rules("quadril","Quadril","trim|required");
        $this->form_validation->set_rules("coxa","Coxa","trim|required");
        $this->form_validation->set_rules("pantorrilha","Pantorrilha","trim|required");
        $this->form_validation->set_rules("peso","Peso","trim|required");
        //$this->form_validation->set_rules("altura","Altura","trim|required");
        
        // Erro na validacao
        if ($this->form_validation->run() == FALSE){
            if (!isset($this->uri->segments[5])) {
                $this->novo();
            } else {
                $this->editar();
            }
        } else {
            
            if ((!isset($this->uri->segments[5]) ? $this->model->inserir() : $this->model->editar())) {
                $this->session->set_flashdata('msg', 'Medida salva com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar a medida');
            }

            redirect(CONTROLLER."/index/".(isset($this->uri->segments[5]) ? $this->uri->segments[5] : $this->uri->segments[4]), 'refresh');//Redireciona para a listagem
        }
    }
}
