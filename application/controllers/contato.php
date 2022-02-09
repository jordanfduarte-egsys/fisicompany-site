<?php 

class Contato extends CI_Controller{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia", true);
        $this->data['noticias'] = $this->noticia->consultar(array("limit"=> "7"));
        
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
        $this->data['pager'] = "contato";
        $this->load->view("abstract/header", $this->data);
        $this->load->view("contato");
        $this->load->view("abstract/footer", $this->data);
    }

    public function enviarEmail()
    {
        $data = $this->input->post();
        $params = array();
        parse_str($data['data'], $params);
        $data = $params;
        
        $body = "Contato | Fisicompany<br/>";
        $body .= "Nome: ".$data['nome'];
        $body .= "<br/>E-mail: ".$data['email'];
        $body .= "<br/>Telefône: ".$data['telefone'];
        $body .= "<br/>Mensagem:<br/>";
        $body .= $data['mensagem']."</p>";

        $posts = array(
            'to'            => $this->data["config"]["fieldsetEmail"]["username"],
            'subject'       => 'Contato | Fisicompany',
            'body'          => $body,
            'nome'          => $data['nome']
        );
        
        $curl = curl_init(PATH_ADM. '/json/mailer');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $posts);

        $resultado = curl_exec($curl);
        curl_close($curl);
     
        echo $resultado;
    }
}
