<?php
class Banner extends MY_Controller
{    
    public function __construct()
    {//intancia da base
        parent::__construct();
        $this->data['title'] = "Banner";
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
        $this->load->model("admin/modules/banner/bannerDAO",'',TRUE);
        
    }
    public function index()
    {
        
        $this->data['banners'] = $this->consultar();        
        $this->load->view("admin/modules/banner/banner",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    public function novo(){
                
        $this->data['acao'] = "Novo Banner";        
        $this->load->view("admin/modules/banner/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }    
    public function editar(){
        $this->data['banner'] = $this->conultarInstancia();        
        $this->data['acao'] = "Editar Banner";        
        $this->load->view("admin/modules/banner/form",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    //
    public function deletar(){        
        $id = (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(3));
        $ordem = $this->bannerDAO->consultaInstanciaId($id);
                
        if($this->bannerDAO->deletar($id)){
            $this->bannerDAO->editaOrdem($ordem->ordem);            
            $this->session->set_flashdata('msg', 'Banner removido com sucesso');            
        }else
            $this->session->set_flashdata('erro', 'Erro ao remover o banner.');
        echo json_encode(true);
    
    }
    public function sortable()
    {    $sql = array();
        $params = array();
                parse_str($_POST['order'], $params);
        foreach ($params['listItem'] as $position => $item) :
             $this->bannerDAO->sortable($position, $item);            
        endforeach;
        echo json_encode(array("status"=>true));
        
    }
    //
    public function conultarInstancia()
    {
        return $this->bannerDAO->consultarInstancia();    
    }
    public function consultar()
    {
        return $this->bannerDAO->consultar();
    }
    public function valida(){
        
        //Validação de inserção e editar.
        //Só mudar o nome da controller e os campos de validação abaixo    
        $this->form_validation->set_rules("titulo","Titúlo","trim|required");
        $this->form_validation->set_rules("imagem","Imagem","trim|required");                        
        if($this->form_validation->run() == FALSE){//Erro na validacao
            if(!isset($this->uri->segments[4]))
                $this->novo();
            else            
                $this->editar();
        }else
        {
                        
            if((!isset($this->uri->segments[4]) ? $this->bannerDAO->inserir() : $this->bannerDAO->editar()))
                $this->session->set_flashdata('msg', 'Banner salvo com sucesso');
            else
                $this->session->set_flashdata('erro', 'Erro ao salvar o Banner');
            
            redirect('/banner/', 'refresh');//Redireciona para a listagem
        }
        
    }
}
