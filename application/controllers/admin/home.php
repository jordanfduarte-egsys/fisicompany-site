<?php
class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->data['title'] = "Home";
        $this->load->view("admin/abstract/header",$this->data);
        $this->load->view("admin/abstract/menu");    
        $this->load->helper('date');
        $this->util->getData();         
        $datestring = "Dia: %d Month: %m Day: %d - %h:%i %a";
        $this->data['data'] = $this->util->getData();
    }
    
    public function index()
    {
        $this->load->view("admin/home",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    
    public function busca()
    {
        $this->load->model("admin/modules/home/homeDAO",'home',TRUE);
        $this->data['palavra'] = $this->input->post("busca");
        $dados = Array();        
        foreach($this->config->config['controllers'] as $i =>$controller):
            $this->load->model("admin/modules/".$controller."/".$controller."DAO",$controller,TRUE);
            $dados[] = $this->home->montaQueryBusca(get_class_vars(get_class($this->$controller)), $this->data['palavra'], $controller);

            $dados[$i]['controller'] = $controller;
        endforeach;    

        $this->data['busca'] = $dados;        
        $this->load->view("admin/pagina/busca",$this->data);
        $this->load->view("admin/abstract/footer");
    }
    
    public function novo(){}//pagina novo
    public function editar(){}//pagina editar
    public function deletar(){}//apresenta modal deletar com os dados
    public function valida(){}//valida novo e grava
    public function conultarInstancia(){}//Consulta um registro com post ou get
    public function consultar(){}
}
