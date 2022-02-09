<?php
class MedidaDAO extends CI_Model
{
    protected $_table = "medida";

    public $id_medida;
    public $id_usuario;
    public $nome;
    public $data;
    public $braco;
    public $antebraco;
    public $peitoral;
    public $cintura;
    public $abdomen;
    public $quadril;
    public $coxa;
    public $pantorrilha;
    public $peso;
    public $altura;    
    
    public function __construct()
    {
        //Obrigatório no construtor para pegar os valores dos posts
        if ($this->input->post()) {
            //foreach dos posts
            foreach($this->input->post() as $i=> $post) {
                //seta a publiciavel
                 $this->$i = str_replace(Array(" cm"," Kg"," m"," "), "",trim($post));
            }
        }

        unset($this->ok);
    }

    public function inserir()
    {
        unset($this->nome, $this->id_medida);
        $this->data = date("Y-m-d"); 
        
        //inserir na tabela permissao
        return $this -> db -> insert($this->_table, $this);
    }

    public function editar()
    {
        $this -> db -> where("id_".$this->_table,$this->id_medida);
        unset($this->id_medida,$this->nome);
        return $this -> db -> update($this->_table, $this);
    }

    public function deletar($id)
    {
        return $this->db->delete($this->_table,array("id_".$this->_table=>$id));
    }  

    public function editaOrdem($ordem)
    {
        return $this->db->query("UPDATE ".$this->_table." set ordem = ordem-1 WHERE ordem > ".$ordem);
    }

    public function consultaInstanciaId($id)
    {
        $this->db->select("medida.* ,usuario.nome ,usuario.sobre_nome ");
        $this->db->from($this->_table);
        $this->db->join("usuario","usuario.id_usuario = medida.id_usuario","inner");
        $this->db->where("id_".$this->_table." =".$id); 
        return $this->db->get()->result()[0];
    }

    public function sortable($position, $item)
    {
        $this->db->where("id_".$this->_table,$item);
        return     $this->db->update($this->_table,array("ordem"=>$position+1));
    }

    public function getOrdem()
    {
        $this->db->select(" COUNT(id_".$this->_table.") as max ");
        $this->db->from($this->_table);
        return $this->db->get()->result()[0]->max+1;
    }

    public function consultar($search = array())
    {
        $this->db->select("medida.*, usuario.nome, usuario.sobre_nome, DATE_FORMAT(data,('%d/%m/%Y')) as data_formatada");
        $this->db->from("medida");
        $this->db->join("usuario","usuario.id_usuario = medida.id_usuario","inner");
            
        if (array_key_exists("id_cliente", $search)) {
            $this->db->where("medida.id_usuario = ".$search['id_cliente']);
        }

        if (array_key_exists("max_data", $search)) {
            $this->db->where("data = (SELECT MAX(data) FROM medida WHERE id_usuario = ".$search['id_cliente'].") ");
        }

        $this->db->order_by("data");
        return $this->db->get()->result();
    }

    public function consultarInstancia($search = array())
    {
        if (array_key_exists("id_cliente", $search)) {
            $this->db->select("medida.*,usuario.nome, usuario.sobre_nome");
        } else {
            $this->db->select("*");
        }

        $this->db->from($this->_table);
        $this->db->join("usuario","usuario.id_usuario = medida.id_usuario","inner");
        $this->db->where("id_".$this->_table." =".$this->uri->segment(4));

        if(array_key_exists("id_cliente", $search)) {
            $this->db->where("medida.id_usuario = ".$search['id_cliente']);
        }
        return $this->db->get()->result()[0];
    }
}
