<?php 

class Galeria extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia",TRUE);
        $this->load->model("admin/modules/galeria/galeriaDAO","galeria",TRUE);    
        $this->data['noticias'] = $this->noticia->consultar(array("limit"=>"7"));//Noticias
        
        //para paginacao
        //$this->data['total_paginas'] = ;
        $this->data['pagina_atual'] = $this->uri->segment(2);
        //if($this->data['pagina_atual'] > 1)
            //$this->data['galerias'] = $this->galeria->consultar(array("limit"=>"9, ".($this->uri->segment(2)*9-9)));
        //else
        //$this->data['galerias'] = $this->galeria->consultar(array("limit"=>"9"));
        $this->load->library('pagination');
 
        $config['total_rows']   = $this->galeria->count_posts();
        $config['base_url']     = site_url() . 'galeria';
        $config['per_page']     = '9';
        $config['uri_segment']  = '2';
        //$config['first_link']   = "<li><<</li>";
        $config['last_link']    = ">>";
        $config['anchor_class'] = "class='number'";
        

        $this->pagination->initialize($config);
        $this->data['galerias'] = $this->galeria->get_all_posts($config['per_page'], $this->data['pagina_atual']);
        
        $this->data['paginacao'] = $this->pagination->create_links();
        
        $this->load->model("admin/modules/config/configDAO",'modelConfigDAO', true);
        $this->data["config"] = $this->modelConfigDAO->consultar();
        $newArrConfig = [];
        foreach ($this->data["config"] as $i => $config) {
            $newArrConfig[$config["nome_config"]] = json_decode($config["parametros"], true);
        }
        $this->data["config"] = $newArrConfig;
    }

    public function index()
    {
        $this->data['pager'] = "galeria";
        $this->load->view("abstract/header", $this->data);
        $this->load->view("galeria",$this->data);
        $this->load->view("abstract/footer",$this->data);
    }

    public function getGaleria()
    {
        $idGaleria = $this->input->post("idgaleria");
        echo json_encode($this->galeria->consultarInstancia(array("id_galeria"=>$idGaleria)));
    }
}
