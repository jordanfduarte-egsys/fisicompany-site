<?php

class Empresa extends CI_Controller
{
    public $data;
    
    public function __construct()
    {
    
        parent::__construct();
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia",TRUE);
        $this->load->model("admin/modules/sobre/sobreDAO","sobre",TRUE);
        $this->data['noticias'] = $this->noticia->consultar(array("limit"=>"7"));
        $this->data['sobres'] = $this->sobre->consultar();
        
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
        $this->data['pager'] = "empresa";
        $this->load->view("abstract/header", $this->data);
        $this->load->view("empresa",$this->data);
        $this->load->view("abstract/footer",$this->data);
    }
}
