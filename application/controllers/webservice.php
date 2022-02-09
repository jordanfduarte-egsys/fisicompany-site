<?php
class Webservice extends CI_Controller
{
    /**
    * BASE 64 da senha '9e0273893d9eff6fd8ab6e6a62f995ae';
    * A SENHA = academia123
    * http://localhost:8080/sistema/webservice/send/user/suporte/pass/9e0273893d9eff6fd8ab6e6a62f995ae/data_type/json 
    */
    
    private $user = "suporte";
    private $pass = "academia123";//base 64
    private $return_type = "json";
    private $dataTypes = Array("json","xml");
    private $request;
    private $returns = Array("status"=>false);
    
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        //validacao de entrada
        //print_r($this->uri->segments);
        //exit;    
        if($this->uri->segments[2] == "send"){
            if(!isset($this->uri->segments[3])){
                echo json_encode(Array("status"=>false,"nivel"=>1, "error"=>"Informe o parametro 'user' e em seguida o usuario auenticado!"));exit;
            }else if(!isset($this->uri->segments[4])){
                echo json_encode(Array("status"=>false,"nivel"=>10, "error"=>"Informe o valor do parametro 'user'!"));exit;
            }else if(trim($this->uri->segments[4]) != $this->user){
                echo json_encode(Array("status"=>false,"nivel"=>2,"error"=>"Usuário informada incorreta!"));exit;
            }else if(!isset($this->uri->segments[5])){
                echo json_encode(Array("status"=>false,"nivel"=>10,"error"=>"Informe o parametro 'pass' e em seguida a senha de  autenticação!"));exit;                
            }else if(!isset($this->uri->segments[5])){
                echo json_encode(Array("status"=>false,"nivel"=>10,"error"=>"Informe o valor do  'pass' e em seguida a senha de  autenticação!"));exit;
            }else if(!isset($this->uri->segments[6])){
                echo json_encode(Array("status"=>false,"nivel"=>10,"error"=>"Informe o valor do  parametro 'pass'!"));exit;
            }else if($this->uri->segments[6] != md5($this->pass)){
                echo json_encode(Array("status"=>false,"nivel"=>4,"error"=>"Senha informada incorreta!"));exit;
            }                
            if(isset($this->uri->segments[7]) and $this->uri->segments[7] == "data_type" and isset($this->uri->segments[8]) and $this->uri->segments[8] != $this->return_type){
                if(!array_key_exists($this->uri->segments[8], $this->dataTypes)){
                    echo json_encode(Array("status"=>false,"nivel"=>5,"error"=>"Data type informado não permitido! Formatos aceitos xml e json."));exit;
                }
                $this->return_type = $this->uri->segments[8];
            }    
        }        
            
    }
    //antes de cada inserção e validado se ja existe o identificador no banco se sim atualiza senão altera o mesmo
    public function send()
    {
        if($this->validateRequest()){
            //LOADER DO MODEL
            $this->load->model("admin/modules/webservice/webserviceDAO","webservice",TRUE);
            //ja temos tudo validado agora so vamos inserir no banco
            //array_reverse vai ficar treinos, medidas, exercicios, clientes
            foreach(array_reverse($this->request) as $i=> $v){
                    if($i == "clientes"){
                        foreach($v as $index => $cliente){
                            //validacao da insercao
                            //id_usuario, id_permissao, nome, sobre_nome, email, senha, foto, acesso_cliente, id_treino
                            $cli['id_usuario_sistema'] = $cliente['cl_id'];
                            $cli['id_permissao'] = null;
                            $cli['nome'] = $cliente['cl_nome'];
                            $cli['sobre_nome'] =$cliente['cl_sobrenome'];
                            $cli['email'] = $cliente['cl_email'];
                            $cli['senha'] = md5("academia");//padrao WEB
                            $cli['foto'] = null;
                            $cli['acesso_cliente'] = 1;
                            $cli['id_treino'] = $cliente['cl_idtreino'];
                            $this->returns['clientes']['id'] = $this->webservice->inserirCliente($cli);
                        }
                        
                    }elseif($i == "exercicios"){
                        foreach($v as $index => $exercicio){
                            $ex['id_exercico_sistema'] = $exercicio['exer_id'];
                            $ex['nome'] = $exercicio['exer_nome'];
                            $ex['imagem'] = null;
                            $ex['descricao'] = $exercicio['exer_observacoes'];
                            $ex['id_categoria'] = 0;
                            $this->returns['exercicios']['id'] = $this->webservice->inserirExercicio($ex);
                        }
                        
                    }elseif($i == "medidas"){
                        foreach($v as $index => $medida){
                            $me['id_medida_sistema'] = $medida['me_idmedida'];
                            $me['id_usuario'] = $medida['me_idcliente'];
                            $me['data'] = $medida['me_data'];
                            $me['braco'] = $medida['me_braco'];
                            $me['antebraco'] = $medida['me_antebraco'];
                            $me['peitoral'] = $medida['me_peitoral'];
                            $me['cintura'] = $medida['me_cintura'];
                            $me['abdomen'] = $medida['me_abdomen'];
                            $me['quadril'] = $medida['me_quadril'];
                            $me['coxa'] = $medida['me_coxa'];
                            $me['pantorrilha'] = $medida['me_pantorrilha'];
                            $me['peso'] = $medida['me_peso'];
                            $me['altura'] = $medida['me_altura'];
                            $this->returns['medidas']['id'] = $this->webservice->inserirMedida($me);
                        }
                    }elseif($i == "treinos"){
                        
                        //"tre_idtreino"=>1,"tre_nome"=>"Treino JORDAN","tre_imagem"=>"josdjojdosjodjos","status"=>1
                        foreach($v as $index => $treino){
                            $tr['id_treino_sistema'] = $treino['tre_idtreino'];
                            $tr['nome'] = $treino['tre_nome'];
                            if(!empty($treino['tre_imagem'])){
                                $img = $this->baixaIMG($treino['tre_imagem'],"media/treino_cliente",null);
                                if($img['status']){//baixo a imagem ?
                                    $tr['imagem'] = $img['md5'];    
                                }else
                                    $tr['imagem'] = null;    
                            }else{
                                $tr['imagem'] = null;
                            }                                
                            $tr['status'] = (int)$treino['status'];
                            $this->returns['treinos']['id'] = $this->webservice->inserirTreino($tr); 
                            
                        }
                        
                    }    
            }
            $this->returns['status'] = true;
        }    
    
        echo json_encode($this->returns);
        exit;
    }
    public function teste()
    {
         $a = Array(
            //treino 2
            "exercicios"=> Array(Array("exer_id"=>10,'exer_nome'=>" 1 Perde a barrifa","exer_observacoes"=>"NN")),
            "treinos"=> Array(Array("tre_idtreino"=>1,"tre_nome"=>" 1 Treino JORDAN","tre_imagem"=>"josdjojdosjodjos","status"=>1)),
            "clientes"=>Array(Array("cl_id"=>1,"cl_nome"=>" 1 Jordan Sistema Delphi","cl_sobrenome"=>"Delphi","cl_email"=>"jordanjoga10@gmail.com","cl_idtreino"=>2)),
            "medidas"=>Array(Array("me_idmedida"=>1,"me_idcliente"=>1,"me_data"=>10,"me_braco"=>20,"me_antebraco"=>88,"me_peitoral"=>10,"me_cintura"=>10,"me_abdomen"=>10,"me_quadril"=>88,"me_coxa"=>9,"me_pantorrilha"=>88,"me_peso"=>77,"me_altura"=>155))
          );//Array principal
         
          $options = array(
              'http' => array(
                'method'  => 'POST',
                'content' => http_build_query( $a ),
                'header'=>  "Content-type: application/x-www-form-urlencoded"
                )
          );
            
          $context  = stream_context_create( $options );
          
          $handle = fopen('http://localhost:8080/sistema/webservice/send/user/suporte/pass/9e0273893d9eff6fd8ab6e6a62f995ae/data_type/json', 'r', false, $context);
          $contents = '';
          while (!feof($handle)) {
             $contents .= fread($handle, 8192);
          }
          fclose($handle);
          echo $contents;
    } 
    
    public function post()
    {
        //array de teste
        echo json_encode(Array(
            //treino 2
            "exercicios"=> Array(Array("exer_id"=>10,'exer_nome'=>" 1 Perde a barrifa","exer_observacoes"=>"NN"),
                                 Array("exer_id"=>11,'exer_nome'=>" 1 Perde a barrifa","exer_observacoes"=>"NN")),
            "treinos"=> Array(Array("tre_idtreino"=>1,"tre_nome"=>" 1 Treino JORDAN","tre_imagem"=>"josdjojdosjodjos","status"=>1),
                              Array("tre_idtreino"=>2,"tre_nome"=>" 1 Treino JORDAN","tre_imagem"=>"josdjojdosjodjos","status"=>1)),
            "clientes"=>Array(Array("cl_id"=>1,"cl_nome"=>" 1 Jordan Sistema Delphi","cl_sobrenome"=>"Delphi","cl_email"=>"jordanjoga10@gmail.com","cl_idtreino"=>1),
                              Array("cl_id"=>2,"cl_nome"=>" 1 Jordan Sistema Delphi","cl_sobrenome"=>"Delphi","cl_email"=>"jordanjoga10@gmail.com","cl_idtreino"=>2)),
            "medidas"=>Array(Array("me_idmedida"=>1,"me_idcliente"=>1,"me_data"=>10,"me_braco"=>20,"me_antebraco"=>88,"me_peitoral"=>10,"me_cintura"=>10,"me_abdomen"=>10,"me_quadril"=>88,"me_coxa"=>9,"me_pantorrilha"=>88,"me_peso"=>77,"me_altura"=>155),
                             Array("me_idmedida"=>2,"me_idcliente"=>2,"me_data"=>10,"me_braco"=>20,"me_antebraco"=>88,"me_peitoral"=>10,"me_cintura"=>10,"me_abdomen"=>10,"me_quadril"=>88,"me_coxa"=>9,"me_pantorrilha"=>88,"me_peso"=>77,"me_altura"=>155))
          ));
    }
    
    private function validateRequest()
    {
        $arquivo = fopen('meuarquivo.txt','w');
        if ($arquivo == false) die('Não foi possível abrir o arquivo.');
        if(!isset($_POST)){
            echo json_encode(array("status"=>false,"nivel"=>11,"Nenhum parametro POST informado!"));
            exit;                
        }
                    
        $escreve = fwrite($arquivo, json_encode($_REQUEST));//guarda o post
        
        $content = file_get_contents('meuarquivo.txt');            
        $this->request = json_decode($content,true);//le novamente o post            
        if(!array_key_exists("treinos", $this->request) || !array_key_exists("clientes", $this->request) || !array_key_exists("medidas", $this->request)){
            echo json_encode(Array("status"=>false,"nivel"=>6,"error"=>"Para completar a requisição é necessário conter treinos, clientes e medidas no pacote sendo enviado!"));exit;
        }
        return true;
    }
    /**
     * @param base64 String base
     * @param caminho String 'media/pasta de destino/
     * @param configuracao se tem ou nao de criar um tumble
     */
    private function baixaIMG($base64, $caminho,$configuracao = null)
    {
        $caminho = "media/treino_cliente";
        $configuracao['create_thumble'] = true;
        //para teste descomentar linha abaixo
        //$base64 = base64_encode(file_get_contents(ASSETS."media/treino_cliente/3a195596b7459b7ea324779f7d5b5226.jpg"));
        $imgdata = "data:image/jpeg;base64,".base64_decode($base64);
        $extension = $this->getMimeType(substr($imgdata, 5, strpos($imgdata, ';')-5));//Extencao
        if ($extension){
            $name = md5(time()).".".$extension;
            file_put_contents(ASSETS."$caminho/$name", $base64);
            return array("md5"=>$name,"formato"=>$extension,"caminho"=>$caminho,"src"=>ASSETS."$caminho/$name","status"=>true);
        } else {
            return array("status"=>false);
        }
    }
    public function getMimeType($mime)
    {
        
        $definitive = array (
             "image/gif"=>"gif",
             "image/jpeg"=>"jpg",
             "image/png"=>"png",
             "image/bmp"=>"bmp",
             "image/tiff"=>"tif",
             "image/jp2"=>"jp2"
        );
        
        if (array_key_exists($mime, $definitive)) {
            return $definitive[$mime];
        } else {
            return false;
        }
    }
}
    