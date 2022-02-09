<?php
class Cliente extends MY_Controller
{
    private $args = array();
    
    public function __construct() {        
        parent::__construct();
        $this->data['title'] = "Clientes";
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }        
        $this->load->model("admin/modules/usuario/usuarioDAO",'',TRUE);
        $this->load->model("admin/modules/permissao/permissaoDAO",'',TRUE);
        $this -> data['permissoes'] = $this -> permissaoDAO-> consultarTodasPermissoes();
        
    }

    //Paginas
    public function index() {
        $this->args = array("acesso_cliente"=>1,"ultima_medida"=>true);
        $this->data["clientes"] = $this->consultar();                
        $this->load->view("admin/modules/cliente/cliente",$this->data);
        $this->load->view("admin/abstract/footer");        
    }
    public function treino(){
        $this->load->model("admin/modules/treino_cliente/treino_clienteDAO",'treinoDAO',TRUE);
        $this->data['treinos'] = $this->treinoDAO->consultar(array("status"=>"1"));        
        $this->data["cliente"] = $this->conultarInstancia();
        $this->data['acao'] = "Treino";
        if(count($this->data["cliente"])){
            $this->data["cliente"] = $this->data["cliente"][0];
        }
        $this->load->view("admin/modules/cliente/treino",$this->data);
        
        
        $this->load->view("admin/abstract/footer");    
    }

    public function novo() {
        redirect("usuario/novo", 'refresh');//Redireciona para o novo
    }
    
    public function editarTreino(){
        $arr = array("status"=>false, "msg"=>"ERRO ao trocar o treino do cliente!");
        if($this->usuarioDAO->editarTreino()){
            $this->load->model("admin/modules/treino_cliente/treino_clienteDAO",'',TRUE);
            if(!$this->input->post("id_treino")){
                $arr = array("status"=>true);    
            }else{
                $treino = $this->treino_clienteDAO->consultaInstanciaId($this->input->post("id_treino"));
                $arr = array("status"=>true , "treino"=>$treino );    
            }
                        
        }
        echo json_encode($arr);        
    }
    public function editar() {
        $this->data['acao'] = "Editar cliente";        
        $this->data["cliente"] = $this->conultarInstancia();    
        $this->data["CONTROLLER"]['isEditar'] = TRUE;
        $this->load->view("admin/modules/cliente/form",$this->data);
        $this->load->view("admin/abstract/footer");        
    }
    public function deletar(){        
        if($this->usuarioDAO->deletar())
            $this->session->set_flashdata('msg', 'Cliente removido com sucesso');            
        else
            $this->session->set_flashdata('erro', 'Erro ao remover o cliente');
        echo json_encode(true);
    }
    public function conultarInstancia()
    {
        return $this->usuarioDAO->consultarInstancia();    
    }
    public function consultar()
    {
        return $this->usuarioDAO->consultar($this->args);
    }
    public function valida(){
        $this -> form_validation -> set_rules("nome", "Nome", "trim|required");
        $this->form_validation->set_rules("sobre_nome","Sobre nome","trim|required");
        $this->form_validation->set_rules("email","E-mail","trim|required|valid_email");        
        $this->form_validation->set_rules('senha', 'Senha', 'required|matches[senhaconf]|min_length[6]');                    
        if($this->form_validation->run() == FALSE){//Erro na validacao
            if(!isset($this->uri->segments[4]))
                $this->novo();
            else            
                $this->editar();
        }else
        {                        
            if((!isset($this->uri->segments[4]) ? $this->usuarioDAO->inserir() : $this->usuarioDAO->editar()))
                $this->session->set_flashdata('msg', 'Cliente salva com sucesso');
            else
                $this->session->set_flashdata('erro', 'Erro ao salvar o cliente');
            
            redirect("cliente", 'refresh');//Redireciona para a listagem
        }
        
    }
}
