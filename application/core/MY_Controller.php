<?php

abstract class MY_Controller extends CI_Controller {
    protected $data = Array();

    public function __construct()
    {
        parent::__construct();
        $this -> verificaLogon();

        $this -> data['module_info'] = array(
            "href" => "/" . (isset($this -> router -> uri -> segments[2]) ? $this -> router -> uri -> segments[2] : ""), 
            "controller" => isset($this -> router -> uri -> segments[2]) ? ucfirst($this -> router -> uri -> segments[2]) : "Home", 
            "metodo" => isset($this -> router -> uri -> segments[3]) ? ucfirst($this -> router -> uri -> segments[3]) : "");

        $this -> data['caminho'] = $this->util->sequencia(
            $this -> data['module_info']['href'],
            $this -> data['module_info']['controller'],
            $this -> data['module_info']['metodo']
        );
        
        //método
        $this -> data['action'] = "/";
        $this -> data['action'] = isset($this -> uri -> segments[2]) ? $this -> uri -> segments[2] . "/valida" : "";
        $this -> data['action'] .= isset($this -> uri -> segments[3]) ? "/" . $this -> uri -> segments[3] : "";
        $this -> data['metodo_pai'] = isset($this -> uri -> segments[2]) 
            ? strtolower(end(preg_split('/([A-Z][^A-Z]+)/', $this -> uri -> segments[2], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY))) 
            : "";
        
        //Controller Padrão
        define("CONTROLLER", isset($this -> uri -> segments[2]) ? $this -> uri -> segments[2] : "home");
    }

    public function verificaLogon()
    {
        $cookie = new Cookies(time(), "fisicompany.com");
        
        try {
            if ($cookie->hasNamespace()) {
                $dados = $cookie->getCookie();
                // Validação da autenticação
                if (in_array("SiteController::siteAction", $dados["modulos"])) {
                     // Valida o hash do cookie com o hash que vamos configura do banco
                    $this->load->model("admin/modules/usuario/usuarioDAO",'modelUsuarioDAO', true);
                    $this->load->model("admin/modules/config/configDAO",'modelConfigDAO', true);
                    
                    $usuarioLogadoCookie = $this->modelUsuarioDAO->consultaUsuarioPorId($dados["id_usuario"]);
                    
                    if ($usuarioLogadoCookie) {
                        $this->data["usuario_loagado"] = $usuarioLogadoCookie;
                        $this->data["cookies"] = $dados;
                        $this->data["config"] = $this->modelConfigDAO->consultar();
                        
                        $newArrConfig = [];
                        foreach ($this->data["config"] as $i => $config) {
                            $newArrConfig[$config["nome_config"]] = array_map('utf8_decode', json_decode($config["parametros"], true));
                        }
                        $this->data["config"] = $newArrConfig;
                        
                        // Busca os parametros                        
                        $hash = $usuarioLogadoCookie->id_usuario . $usuarioLogadoCookie->cpf. $usuarioLogadoCookie->id_usuario;
                        $hash = substr(md5($hash), 2, 16);
                        
                        // Tem permissão
                        if ($hash == $dados["hash"]) {
                            if (isset($this -> router -> uri -> segments[2]) && $this -> router -> uri -> segments[2] == "login") {
                                redirect("home");
                            }
                            
                            $this -> data['saudacao'] = $this ->util-> saudacoes() . "<span>" . $dados["nome"] . "</span>";
                            $this -> data['usuario_logado'] = $dados["nome"];
                        } else {
                            throw new Exception("Sem acesso ao recurso!");
                        }
                        
                    } else {
                        throw new Exception("Sem acesso ao recurso!");
                    }
                } else {
                    throw new Exception("Sem acesso ao recurso!");
                }
            } else {
               throw new Exception("Sem acesso ao recurso!");
            }
            
        } catch (Exception $e) {
            if ($e->getCode() == 1001) {
                $this -> session -> set_flashdata('msg', $e->getMessage());
            }
            redirect("../");
        }
       
        
        // Validar a sessão do usuário
        // com base no cookie adicionado no adm authenticate
        // copiar classe que estou utilizando lá
        // refatorar esse sistema e passar a utilizar tudo isso,
        // retirar alguns recursos, deixando mais limitado
       
        
//         if ($this -> session -> userdata('isLogado') or $this -> input -> cookie("isLogado")) {
            
//             //se tiver acesso verifica se tem acesso ao modulo
//             $usuario_logado = $this -> session -> userdata('permissao_modulo');
        
//             if(!$this -> session -> userdata('dados_usuario_logado'))    
//             {
//                 $this->session->sess_destroy();
//                 delete_cookie("isLogado");
//                 redirect("../admin/","refresh");
//             }
                    
//             $this -> data['saudacao'] = $this ->util-> saudacoes() . "<span>" . $this -> session -> userdata('dados_usuario_logado') -> nome . "</span>";
//             $this -> data['usuario_logado'] = $this -> session -> userdata('dados_usuario_logado') -> nome . " " . $this -> session -> userdata('dados_usuario_logado') -> sobre_nome;
//             $isPermissao = false;
//             //verifica se usuario tem acesso ao modulo
//             foreach ($usuario_logado as $modulo) :
//                 if (@$this -> uri -> segments[2] == $modulo) {
//                     $isPermissao = true;
//                     break;
//                 }
//             endforeach;
//             // print_r($usuario_logado);
//             // echo $isPermissao;
//             // echo "OK";
//             // echo $_SERVER['REDIRECT_URL'];
//             // exit;
//             //verifica se não esta em paginas defaults
//             foreach ($this->config->config['paginas'] as $pg) :
//                 if (!$isPermissao and @$this -> uri -> segments[2] == $pg)
//                     $isPermissao = true;
//             endforeach;

//             //verifica se ainda esta negado
//             if (!$isPermissao) {
//                 if($_SERVER['REDIRECT_URL'] != "/sistema/admin")
//                     $this -> session -> set_flashdata('msg', 'Ops!. Você não tem permissão para acessar este modulo.');
                
//                 redirect("home", "refresh");
//             }

//         } else
//             redirect("login", "refresh");
    }
    
    abstract public function novo();//pagina novo
    abstract public function editar();//pagina editar
    abstract public function deletar();//apresenta modal deletar com os dados
    abstract public function valida();//valida novo e grava
    abstract public function conultarInstancia();//Consulta um registro com post ou get
    abstract public function consultar();
}