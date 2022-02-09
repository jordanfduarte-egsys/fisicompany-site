<?php 

class Index extends CI_Controller
{
    public $data;

    public function __construct()
    {    
        parent::__construct();
                
        $this->load->model("admin/modules/banner/bannerDAO",'banner', true);
        
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia", true);
        $this->load->model("admin/modules/modalidade/modalidadeDAO","modalidade", true);
        $this->data['banners'] = $this->banner->consultar();//banner        
        $this->data['noticias'] = $this->noticia->consultar(array("limit"=>"7"));//Noticias
        $this->data['modalidades'] = $this->modalidade->consultar();
        
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
        $this->data["isHome"] = true;
        $this->data['pager'] = "home";
        $this->load->view("abstract/header",$this->data);
        $this->load->view("index");
        $this->load->view("abstract/footer");
    }
}
