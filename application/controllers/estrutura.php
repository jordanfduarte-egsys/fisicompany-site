<?php 

class Estrutura extends CI_Controller
{
    public $data;

    public function __construct()
    {
    
        parent::__construct();    
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia", true);
        $this->load->model("admin/modules/estrutura/estruturaDAO","estrutura", true);
        $this->data['estruturas'] = $this->estrutura->consultar();
        $this->data['noticias'] = $this->noticia->consultar(array("limit"=>"7"));
        
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
        $this->data['pager'] = "estrutura";
        $this->load->view("abstract/header",$this->data);
        $this->load->view("estrutura");
        $this->load->view("abstract/footer",$this->data);
    }

}
