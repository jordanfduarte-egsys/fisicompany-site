<?php 

class Index extends MY_Cliente
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/modules/noticia/noticiaDAO","noticia", true);
        $this->data['noticias'] = $this->noticia->consultar(array("limit"=> "7"));
        
        $this->load->model("admin/modules/usuario/usuarioDAO","usuarioDAO",TRUE);
        $this->data['id_usuario_logado'] = $this->session->userdata("id_cliente");
        
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
         $this->data['usuario'] = $this->usuarioDAO->consultar(array("id_cliente"=> $this->data['id_usuario_logado']));
         //exit;
         $this->data['usuario'] = $this->data['usuario'][0];
         $this->load->model("admin/modules/medida/medidaDAO","medidaDAO", true);
         $this->data['medidas'] = $this->medidaDAO->consultar(array("id_cliente"=>$this->data['id_usuario_logado'], "max_data"=>true));

         $this->data['title'] = "Home";
         $this->load->view("cliente/abstract/header", $this->data);
         $this->load->view("cliente/abstract/menu");
         $this->load->view("cliente/index");
         $this->load->view("cliente/abstract/footer");
    }

    public function meusDados()
    {
        $this->data['title'] = "Meus dados";
        $this->load->model("admin/modules/usuario/usuarioDAO","usuario",TRUE);
        $this->data['usuario'] = $this->usuario->consultaInstanciaTipoPermissao($this->data['id_usuario_logado'])[0];
        
        $this->load->view("cliente/abstract/header",$this->data);
        $this->load->view("cliente/abstract/menu");
        $this->load->view("cliente/pagina/meusDados",$this->data);
        $this->load->view("cliente/abstract/footer");
    }

    public function medida()
    {
        $this->load->model("cliente/medidaDAO","medida",TRUE);
        $this->data['title'] = "Medidas";
        $this->data['medidas'] = $this->medida->consultar(array("id_usuario"=>$this->data['id_usuario_logado'],"id_usuario_logado"=>$this->data['id_usuario_logado']));
        $this->load->view("cliente/abstract/header",$this->data);
        $this->load->view("cliente/abstract/menu");
        $this->load->view("cliente/pagina/medida",$this->data);
        $this->load->view("cliente/abstract/footer");
    }

    public function treino()
    {
        $this->data['usuario'] = $this->usuarioDAO->consultar(array("id_cliente"=>$this->data['id_usuario_logado']));
        $this->data['usuario'] = $this->data['usuario'][0];
        
        $this->data['title'] = "Treinos";
        $this->load->model("cliente/treinoDAO","treino",TRUE);
        //$this->data['treinos'] = $this->treino->consultar($this->data);        
        $this->load->view("cliente/abstract/header",$this->data);
        $this->load->view("cliente/abstract/menu");
        $this->load->view("cliente/pagina/treino",$this->data);
        $this->load->view("cliente/abstract/footer");
        
    }

    public function exercicio()
    {
        $this->load->model("admin/modules/exercicio/exercicioDAO","exercicio",TRUE);
        $this->data['exercicios'] = $this->exercicio->consultar();
        $this->data['title'] = "Exercicios";
        $this->load->view("cliente/abstract/header",$this->data);
        $this->load->view("cliente/abstract/menu");
        $this->load->view("cliente/pagina/exercicio",$this->data);
        $this->load->view("cliente/abstract/footer");
    }
    
    public function getMedidaDate()
    {
        $this->load->model("cliente/medidaDAO","medida",TRUE);
        echo json_encode($this->medida->consultarMes(array("id_usuario"=>"7","data"=>$this->input->post("data"))));
    } 

    public function valida()
    {
        
        $this->form_validation->set_rules('senha', 'Senha', 'required|matches[senhaconf]|min_length[6]');
                    
        if (!$this->form_validation->run()) {//Erro na validacao
            $this->meusDados();
        } else {
            
            $this->load->model("admin/modules/usuario/usuarioDAO","usuario", true);
            
            if ($this->usuario->editar()) {
                $this->session->set_flashdata('msg', 'Configuração salva');
            } else {
                $this->session->set_flashdata('erro', 'Erro ao salvar as configurações');
            }

            redirect("cliente/index/meusDados", 'refresh');//Redireciona para a listagem
        }
    }

    public function iframe()
    {
        
        echo "<html><head>";
             echo '<link type="text/css" rel="stylesheet" href="'.BASE_PATH.
            'assets/css/bootstrap.min.css"/><link type="text/css" rel="stylesheet" href="'.BASE_PATH.
            'assets/css/bootstrap.min.css"/>'.
            '<link type="text/css" rel="stylesheet" href="'.BASE_PATH.'/assets/js/DataTables-1.9.4/media/css/jquery.dataTables_themeroller.css">'.
            '</head><body>';      
        echo "</head><body>";
            echo "<div id='iframeContent'>";
            echo "</div>";
        echo "</body></html>";
    
    }

    public function login()
    {
        $this->data['title'] = "Cliente Fisicompany";
        $this->data["pager"] = "home";
        $this->load->view("abstract/header", $this->data);
        $this->load->view("cliente/pagina/login",$this->data);
        $this->load->view("abstract/footer", $this->data);
    }
    
    public function upload()
    {
        $posts = [
            'id_usuario'        => $_POST["id_usuario"],
            'arquivo'           => base64_encode(file_get_contents(getcwd() . $_POST["prefix"] . $_POST["arquivo"])),
            'nome_imagem'       => $_POST["arquivo"]
        ];
        $curl = curl_init(PATH_ADM . '/json/upload-imagem-perfil');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $posts);
        
        @unlink(getcwd() . $_POST["prefix"] . $_POST["arquivo"]);
        @unlink(getcwd() . $_POST["prefix"] . "thumb/" . $_POST["arquivo"]);
        
        try {
            $resultado = curl_exec($curl);
            curl_close($curl);
        } catch (Exception $e) {
            $resultado = json_encode([
                'result'        => false,
                'message'       => "Erro na solicitação com o webservice"
            ]);
        }
         
        echo $resultado;
    }
    
    public function extrato()
    {
        $this->load->model("admin/modules/usuario/usuarioDAO","usuarioDAO", true);
        $this->data["sumCredito"] = $this->usuarioDAO->sumCaixaByFatura($this->data['id_usuario_logado']);
    
        if ($_POST) {
            $post = $_POST;
    
            if ($post["data_de"] && $post["data_ate"]) {
                $this->data["extratos"] = $this->usuarioDAO->findExtrato($this->data['id_usuario_logado'], $post["periodo"], $post["data_de"], $post["data_ate"]);
                
            } else {
                $this->data["extratos"] = $this->usuarioDAO->findExtrato($this->data['id_usuario_logado'], $post["periodo"]);
            }
        } else {
            $this->data["extratos"] = $this->usuarioDAO->findExtrato($this->data['id_usuario_logado']);
        }
    
        $this->load->view("cliente/abstract/header",$this->data);
        $this->load->view("cliente/abstract/menu");
        $this->load->view("cliente/pagina/extrato",$this->data);
        $this->load->view("cliente/abstract/footer");
    }
}
