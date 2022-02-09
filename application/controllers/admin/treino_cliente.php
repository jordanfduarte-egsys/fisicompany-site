<?php 

class Treino_cliente extends MY_Controller{

    public function __construct()
    {//intancia da base
        parent::__construct();
        $this->data['title'] = "Treinos";

        //requisição ajax
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        
        $this->load->model("admin/modules/treino_cliente/treino_clienteDAO",'treino',TRUE);
    }
    
    public function index()
    {
        
        $this->data['treinos'] = $this->consultar();
        $this->load->view("admin/modules/treino_cliente/treino",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    
    public function novo()
    {
                
        $this->data['acao'] = "Novo Treino";
        $this->load->view("admin/modules/treino_cliente/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function editar()
    {
        $this->data['treino'] = $this->conultarInstancia();
        $this->data['acao'] = "Editar Treino";
        $this->load->view("admin/modules/treino_cliente/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }

    public function deletar()
    {
        $id = (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(3));
        
        //antes de deletar vamos ver se pode deletar
        $this->load->model("admin/modules/usuario/usuarioDAO",'usuarioDAO',TRUE);
        $users = $this->usuarioDAO->consultar(Array("id_treino"=>$id));
        
        if(count($users)) {
            echo json_encode(array("status"=>false,"isShowMessage"=>true,"msg"=>"Existem clientes cadastrados com esse treino. Processo cancelado!"));
            exit;
        }

        $ordem = $this->treino->consultaInstanciaId($id);

        if($this->treino->deletar($id)) {
            $this->session->set_flashdata('msg', 'Treino removido com sucesso');
        }else {
            $this->session->set_flashdata('erro', 'Erro ao remover o treino.');
        }
        
        echo json_encode(true);
    }

    public function sortable()
    {   
        $sql = array();
        $params = array();
                parse_str($_POST['order'], $params);
        foreach ($params['listItem'] as $position => $item) :
             $this->treino->sortable($position, $item);
        endforeach;
        
        echo json_encode(array("status"=>true));
    }

    public function conultarInstancia()
    {
        return $this->treino->consultarInstancia();
    }

    public function consultar()
    {
        return $this->treino->consultar();
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
            if ((!isset($this->uri->segments[4]) ? $this->treino->inserir() : $this->treino->editar())) {
                $this->session->set_flashdata('msg', 'Treino salvo com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar o Treino');
            }
            
            redirect('/treino_cliente/', 'refresh');//Redireciona para a listagem
        }
    }
}
