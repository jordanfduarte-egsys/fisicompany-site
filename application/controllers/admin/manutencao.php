<?php
class Manutencao extends MY_Controller
{
    public function __construct()
    {    //intancia da base
        parent::__construct();
        $this->data['title'] = "Manutenção";
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {//requisição ajax
            $this->load->view("admin/abstract/header",$this->data);
            $this->load->view("admin/abstract/menu");
        }
    }
    
    public function index()
    {
        $this->data['acao'] = "Perfil";
        $this->data["controllers"] = $this->config->config['controllers'];
        $this->load->view("admin/pagina/".CONTROLLER, $this->data);
        $this->load->view("admin/abstract/footer");
    }
    
    public function limpezaModulo()
    {
        
        $modulo = $this->input->post("modulo");
        $this->load->model("admin/modules/manutencao/manutencaoDAO",'model',TRUE);
        $path = "./././assets/media/".$modulo."/";
        if(!is_dir($path)) {
                echo json_encode(array("status"=>FALSE, "log"=>"Não existe cadastro de imagem para o modulo de ".$modulo));
                exit;
        }
        
        $diretorio = dir($path);
        $log = "<b>Log:</b> inicializando diretório ".$modulo."<br/><b>Log:</b> listando arquivos e diretórios<br/><b>Log:</b> verificando...<br/>";

        while($arquivo = $diretorio -> read()) {
            //validação de leitura
            if(str_replace(".","",$arquivo) == "")
                continue;            
            if(is_file($path.$arquivo)){//se for um arquivo
            
                $row = $this->model->consultaImagem($arquivo, $modulo);
                if(!count($row)){
                    @unlink($path.$arquivo);
                    $log .= "<b>Log:</b> imagem ".$arquivo." removida da pasta ".str_replace("/","",$modulo)."<br/>";
                }
            }else{// é uma pasta
                $log .= "<b>Log:</b> sub diretôrio encontrado<br/>";
                $arquivo_sub_pasta = dir($path.$arquivo."/");
                while($sub_pasta =  $arquivo_sub_pasta-> read()){
                    if(str_replace(".","",$sub_pasta) == "")
                        continue;
                    $row2 = $this->model->consultaImagem($sub_pasta,$modulo);
                    if(!count($row2)){
                        @unlink($path.$arquivo."/".$sub_pasta);
                        $log .= "<b>Log:</b> imagem ".$sub_pasta." removida da pasta ".$modulo."/".str_replace("/","",$sub_pasta)."<br/>";
                    }
                }
                $arquivo_sub_pasta -> close();
            }
        } 
        $log .= "<b>Log:</b> verificação finalizada.<br/>";
        $diretorio -> close();
        echo json_encode(array("status"=>TRUE,"log"=>$log));
    }
    
    public function valida() {
        return $this->model->consultarInstancia();
    }
    
    public function novo(){}
    public function editar(){}
    public function deletar(){}
    public function conultarInstancia(){}
    public function consultar(){}
    
}
