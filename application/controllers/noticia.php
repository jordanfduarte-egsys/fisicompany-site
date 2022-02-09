<?php

class Noticia extends CI_Controller
{
    public $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia",TRUE);
        $this->data['isNoticias'] = TRUE;
        $this->data['mais_acessadas'] = $this->noticia->consultar(array("order"=>"contador","limit"=>"6"));
        $this->data['arquivos'] = $this->noticia->arquivosMes();

        //PAGINACAO    
        $this->data['pagina_atual'] = $this->uri->segment(2);
        $this->load->library('pagination'); 
        $this->data['paginator']['total_rows']          = $this->noticia->count_posts();
        $this->data['paginator']['base_url']            = site_url() . 'noticia';
        $this->data['paginator']['per_page']            = '10';
        $this->data['paginator']['uri_segment']         = '2';
        $this->data['paginator']['last_link']           = ">>";
        $this->data['paginator']['anchor_class']        = "class='number'";

        $this->pagination->initialize($this->data['paginator']);
        
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
        $this->data['noticias'] = $this->noticia->get_all_posts($this->data['paginator']['per_page'], $this->data['pagina_atual']);
        $this->data['paginacao'] = $this->pagination->create_links();
        
        $this->data['pager'] = "noticia";
        $this -> load -> view("abstract/header", $this->data);
        $this -> load -> view("noticia");
        $this -> load -> view("abstract/footer",$this->data);
    }

    public function noticiInterna()
    {
        $this->data['noticia_interna'] = $this->noticia->consultarInstancia(Array("urlrewrite"=>$this->uri->segment(2)));
        $this->data['isNoticias'] = FALSE;
        $this->data['outros'] = $this->noticia->consultar(array("urlrewrite_diff"=>$this->uri->segment(2),"limit"=>3));
        $this->data['pager'] = "noticia";
        //contador de acesso
        $this->noticia->novoAcesso($this->data['noticia_interna'][0]);
        $this -> load -> view("abstract/header", $this->data);
        $this -> load -> view("noticia_interna", $this->data);
        $this -> load -> view("abstract/footer",$this->data);
        
    }
    
    public function noticiaPorMes()
    {
        
        $this->data['paginator']['total_rows'] = $this->noticia->count_posts(array("data"=>$this->uri->segment(3)."-".$this->uri->segment(2)));        
        $this->data['pagina_atual'] = $this->uri->segment(4);
        $this->data['paginator']['uri_segment'] = "4";
        $this->data['paginator']['base_url'] = base_url()."noticia/".$this->uri->segment(2)."/".$this->uri->segment(3); 
        $this->pagination->initialize($this->data['paginator']);
        $this->data['noticias'] = $this->noticia->get_all_posts($this->data['paginator']['per_page'], $this->data['pagina_atual'], array("data"=>$this->uri->segment(3)."-".$this->uri->segment(2)));        
        $this->data['paginacao'] = $this->pagination->create_links();
        
        //$this->data['noticias'] = $this->noticia->consultar(Array("data"=>$this->uri->segment(3)."-".$this->uri->segment(2)));
        $this->data['pager'] = "noticia";
        $this -> load -> view("abstract/header", $this->data);
        $this -> load -> view("noticia");
        $this -> load -> view("abstract/footer",$this->data);
    }
}
