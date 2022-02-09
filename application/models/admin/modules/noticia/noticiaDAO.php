<?php
class NoticiaDAO extends CI_Model{
    
    protected $_table = "noticia";
    
    public $titulo;
    public $resumo;    
    public $imagem_principal;
    public $id_noticia;
    public $texto;
    public $contador = 0;
    public $data;
    public $urlrewrite;
    public $m2ys;
    
    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        parent::__construct();
        
        if($this->input->post()) {
            foreach($this->input->post() as $i=> $post) {

                //seta a publiciavel
                 $this->$i = $post;
            }
        }

        unset($this->ok);
    }

    public function inserir()
    {
        $googl = new Googl();
        $this->urlrewrite = $this->util->geraUrlLimpa($this->titulo.$this->id_noticia);
        $urlrewrite = self::getLocalUrl()."/noticia/".$this->urlrewrite;
         
        try {
            if (!$googl->encurtar($urlrewrite)) {
                $this->m2ys = $googl->url_curta;
            } else {
                throw new Exception("Erro ao criar a URL encurtada!");
            }
        } catch(Exception $e) {
             $this->m2ys = $urlrewrite;
        }         
        $this->data = date('Y-m-d');
        unset($this->id_noticia);
        //inserir na tabela permissao
        $this -> db -> insert($this->_table, $this);
        $idnoticia = $this->db->insert_id();
        if ($idnoticia) {
            foreach($this->input->post("imagem") as $imagem) {
                $this->db->insert($this->_table."_imagem", array(
                    "id_noticia"=>$idnoticia,
                    "imagem"=>$imagem
                ));
            }
        }

        return $idnoticia;
    }

    public function editar()
    {
         $googl = new Googl();
         $this->urlrewrite = $this->util->geraUrlLimpa($this->titulo.$this->id_noticia);
         $urlrewrite = self::getLocalUrl()."/noticia/".$this->urlrewrite;
         
         try {
            if (!$googl->encurtar($urlrewrite)) {
                $this->m2ys = $googl->url_curta;
            } else {
                throw new Exception("Erro ao criar a URL encurtada!");
            }
         } catch(Exception $e) {
             $this->m2ys = $urlrewrite;
         }
         $this->db->delete($this->_table."_imagem",array("id_".$this->_table=> $this->id_noticia));
         foreach ($this->input->post("imagem") as $imagem) {
            $this->db->insert($this->_table."_imagem",array(
                "id_noticia"=>$this->id_noticia,
                "imagem"=>$imagem
            ));
         } 

         $this -> db -> where("id_".$this->_table,$this->id_noticia);
         return $this -> db -> update($this->_table, $this);
    }

    public function deletar()
    {
        $this->db->delete($this->_table."_imagem",array("id_".$this->_table=> (isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));
        return $this->db->delete($this->_table ,array("id_".$this->_table=>(isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));
        
    }

    public function getOrdem()
    {
        $this->db->select(" COUNT(id_".$this->_table.") as max ");
        $this->db->from($this->_table);
        return $this->db->get()->result()[0]->max+1;
    }

    public function novoAcesso($noticia)
    {
        $this->db->query("UPDATE noticia SET contador = contador+1 WHERE id_noticia=".$noticia->id_noticia);
        
    }

    public function arquivosMes()
    {
        $this->db->select("count(id_noticia) as conta, DATE_FORMAT(data, ('%m')) as mes, DATE_FORMAT(data, ('%Y')) as ano");
        $this->db->from("noticia");
        $this->db->where("YEAR(data) > YEAR(curdate())-1");
        $this->db->group_by("MONTH(data)");
        $this->db->order_by("mes","desc");
        return $this->db->get('','6')->result();
    }

    public function consultar($dados = Array())
    {
        $this->db->select("*");
        $this->db->select("DATE_FORMAT(data,('%d/%m/%Y')) as data_br",FALSE);
        $this->db->from($this->_table);

        if (array_key_exists("urlrewrite_diff", $dados)) {
            $this->db->where("urlrewrite != '".$dados['urlrewrite_diff']."'");
        }

        if (array_key_exists("data", $dados)) {
            $this->db->like("data",$dados['data']);
        }

        if (array_key_exists("order", $dados)) {
            $this->db->order_by($dados['order'],"desc");
        } else {
            $this->db->order_by("data","desc");
        }

        if (array_key_exists("limit", $dados)) {
            return $this->db->get('', $dados['limit'])->result();
        } else { 
            return $this->db->get()->result();
        }
    }

    public function consultarInstancia($dados = Array())
    {
        $this->db->select("*, DATE_FORMAT(data,('%d/%m/%Y')) as data_br");
        $this->db->from($this->_table);
        $this->db->join($this->_table."_imagem", $this->_table."_imagem.id_noticia = ".$this->_table.".id_noticia");
        if (array_key_exists("urlrewrite", $dados)) {
            $this->db->where($this->_table.".urlrewrite ='".$dados['urlrewrite']."'");
        } else {
            $this->db->where($this->_table.".id_".$this->_table." =".$this->uri->segment(4));
        }

        $this->db->order_by("noticia.imagem_principal = noticia_imagem.imagem desc");
        return $this->db->get()->result();
    }

    public function get_all_posts($limit, $start, $data = array())
    {
         $this->db->limit($limit, $start);
         if (array_key_exists("data", $data)) {
            $this->db->like("data",$data['data']);
         }

         $query = $this->db->get('noticia');
         return $query->result();
    }

    public function count_posts($data = array())
    {
      if (array_key_exists("data", $data)) {
          return $this->db->like("data",$data['data'])->get("noticia")->num_rows();
      }

      return $this->db->count_all('noticia');
    }
    
    public static function getLocalUrl()
    {
        return $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . (
            $_SERVER["SERVER_PORT"] != 80 ? $_SERVER["SERVER_PORT"] : "");
    }
}