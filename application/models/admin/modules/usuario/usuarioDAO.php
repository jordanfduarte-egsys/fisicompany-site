<?php
class UsuarioDAO extends CI_Model
{
    const PERMISSAO_CLIENTE = "AcessoController::clienteAction";
    
    protected $_table = "usuario";

    public $nome;
    public $sobre_nome;
    public $email;
    public $senha;
    public $id_permissao;
    public $id_usuario;
    public $foto;
    public $senhaconf;
    
    public function __construct()
    {
        parent::__construct();
        
        if($this->input->post()) {
            foreach($this->input->post() as $i=> $post) {
                $this->$i = $post;
            }
        }
        unset($this->senhaconf);
        unset($this->acesso_cliente);
        unset($this->ok);

    }

    public function inserir()
    {
        unset($this->id_usuario);//Deleta a instancia de id_usuario par anão atrapalhar no inserção ou criar um array
        unset($this->foto);
        $this -> senha = md5($this->input->post("senha"));
        $this -> db -> insert($this->_table,$this);
        return $this->db->insert_id();
    }

    public function editar()
    {    
        $this -> senha = md5($this->input->post("senha"));
        $this -> db -> where("id_usuario",$this->id_usuario);
        return $this -> db -> update("usuario", $this);
        
        

    }

    public function editarTreino()
    {
        $this -> db -> where("id_usuario",$this->input->post("id_usuario"));
        return $this -> db -> update("usuario", array("id_treino"=>$this->input->post("id_treino")));

    }

    public function deletar()
    {
        return $this->db->delete($this->_table,array("id_usuario"=>(isset($_POST['idinstancia']) ? $_POST['idinstancia'] :  $this->uri->segment(4))));

    }

    public function consultar($search = array())
    {
        $ultima_medida = "";
        if (array_key_exists("ultima_medida", $search)) {
            $ultima_medida = " ,DATE_FORMAT((SELECT MAX(data) from medida WHERE id_usuario = usuario.id_usuario),('%d/%m/%Y')) as ultima_medida ";
        }
        
        $this->db->select("*, permissao.nome as permissao_nome, usuario.nome as usuario_nome, treino_cliente.nome as nome_treino, treino_cliente.imagem $ultima_medida");
        $this->db->from("usuario");
        $this->db->join("permissao", "permissao.id_permissao = usuario.id_permissao","left");
        $this->db->join("treino_cliente", "treino_cliente.id_treino_cliente = usuario.id_treino","left");

        if (array_key_exists("acesso_cliente", $search)) {
            $this->db->where("acesso_cliente = ".$search['acesso_cliente']);
        }
        
        if(array_key_exists("id_cliente", $search)) {
            $this->db->where("id_usuario = ".$search['id_cliente']);
        }
        
        if(array_key_exists("id_treino", $search)) {
            $this->db->where("id_treino = ".$search['id_treino']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function consultarInstancia()
    {
        $this->db->select('*');
        $this->db->from("usuario");
        $this->db->where("id_usuario = ".(isset($_POST['id_usuario']) ? $_POST['id_usuario'] :  $this->uri->segment(4)) );
        $query = $this->db->get();
        return $query->result();
    }

    public function consultaInstanciaTipoPermissao($id_usuario)
    {
        $this->db->select('*, usuario.nome as cliente_nome');
        $this->db->from("usuario");
        $this->db->where("id_usuario = ".$id_usuario );
        $this->db->join("permissao", "permissao.id_permissao = usuario.id_permissao");
        $query = $this->db->get();
        return $query->result();
    }

    public function consultaUsuario()
    {
        $this->db->select('*');
        $this->db->from("usuario");
        $this->db->where("email = '".(isset($_POST['login']) ? $_POST['login'] :  $this->uri->segment(4)) ."'");
        $query = $this->db->get(); 

        $arrReturn = [
            'result'        => false
        ];
        
        $cliente = $query->row_object();
        if ($cliente) {
            if (isset($this->input->post()['isCliente'])) {
                $permissoes = $this->consultaUsuarioPermissao($cliente->id_usuario);
                
                $userAllow = false;
                foreach ($permissoes as $permissao) {
                    if ($permissao->permissao_modulo_nome == self::PERMISSAO_CLIENTE) {
                        $userAllow = true;
                        break;
                    }
                }
                
                if (!$userAllow || $cliente->status == 0) {
                    $arrReturn = [
                        'status'    => false,
                        'msg'       => "Cliente sem acesso a suas informações. Contate o administrador do sistema."
                    ];
                }
            } else {
                if($cliente->id_permissao == 0 || empty($cliente->id_permissao)) {
                    $arrReturn = [
                        'status'    => false,
                        'msg'       => "Cliente sem acesso a suas informações. Contate o administrador do sistema."
                    ];
                }
            }
            
            if ($cliente->senha == md5($_POST['senha'])) {
                @session_start();
                @session_destroy();

               $arrReturn = [
                    'status'    => true,
                    'usuario'   => $cliente
                ];
            } else {
                $arrReturn = [
                    'status'    => false,
                    'msg'       => "Ops! Senha incorreta."
                ];
            }
        } else {
            $arrReturn = [
                'status'    => false,
                'msg'       => "Ops! Login incorreto."
            ];
        }

        return $arrReturn;
    }

    public function consultaUsuarioPermissao($id_usuario)
    {
        $this->db->select("*, permissao.nome as permissao_nome, usuario.nome as usuario_nome, permissao_modulo.nome as permissao_modulo_nome ");
        $this->db->from("usuario");
        $this->db->join("permissao", "permissao.id_permissao = usuario.id_permissao");
        $this->db->join("permissao_modulo", "permissao.id_permissao = permissao_modulo.id_permissao");
        $this->db->where("usuario.id_usuario = ".$id_usuario." ");
        $query = $this->db->get();
        return $query->result();
    }

    public function consultaUsuarioPorId($idUsuario)
    {
        $this->db->select("*");
        $this->db->from("usuario");
        $this->db->where("usuario.id_usuario = ".$idUsuario." ");
        $query = $this->db->get();
        
        return $query->first_row();
    }
    
    public function findExtrato($idUsuario, $periodo = 90, $apartirDe = null, $ate = null)
    {
        $where = '';
        if ($apartirDe != null && $ate != null) {
            $where = sprintf(' AND c.dt_pagamento BETWEEN "%s 00:00:00" AND "%s 23:59:59" ', $apartirDe, $ate);
        } else {
            $where = sprintf(' AND c.dt_pagamento  > (DATE_SUB(CURDATE(), INTERVAL %d DAY)) ', $periodo);
        }
        
        $sql = sprintf('SELECT 
                c.vlr_pago,
                c.dt_pagamento,
                c.id_fatura,
                c.desc_pagamento,
                c.id_tipo_entrada_caixa,
                t.nome_tipo,
                CONCAT(u.nome, " ", u.sobre_nome) as nome_completo,
                f.id_usuario_cancelamento,
                f.dt_cancelamento,
                f.status,
                CONCAT(uu.nome, " ", uu.sobre_nome) as nome_cancelamento,
                f.dt_cancelamento as data_cancelamento,
                IFNULL(CONCAT(uuu.nome, " ", uuu.sobre_nome), null) as usuario_operador,
                IF(c.id_tipo_entrada_caixa = 2, (SELECT SUM(cc.vlr_pago) FROM caixa cc WHERE cc.id_tipo_entrada_caixa = 2 AND cc.id_caixa <= c.id_caixa AND cc.id_usuario = c.id_usuario), NULL) as sum_extrato
            FROM caixa c
            LEFT JOIN fatura f ON c.id_fatura = f.id
            INNER JOIN tipo_entrada_caixa t ON c.id_tipo_entrada_caixa = t.id
            INNER JOIN usuario u ON c.id_usuario = u.id_usuario
            LEFT JOIN usuario uu ON f.id_usuario_cancelamento = uu.id_usuario
            LEFT JOIN usuario uuu ON c.id_usuario_operador = uuu.id_usuario
            WHERE c.id_usuario = %d %s ORDER BY c.dt_pagamento ASC', $idUsuario, $where);

        $my_sql = $this->db->query($sql);
        return $my_sql->result_array();
    }
    
    public function sumCaixaByFatura($idUsuario)
    {
     
        $sql = sprintf('
            select sum(c.vlr_pago) as total, tec.nome_tipo, tec.id as id_tipo_pagamento
            from caixa c
            inner join tipo_entrada_caixa tec on c.id_tipo_entrada_caixa = tec.id
            WHERE c.id_usuario = %d
            group by c.id_tipo_entrada_caixa', $idUsuario);

        $my_sql = $this->db->query($sql);
        return $my_sql->result_array();
    }
}