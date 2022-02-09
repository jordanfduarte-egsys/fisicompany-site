<?php
class WebserviceDAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserirCliente($cliente){
        if (!$this->checkCliente($cliente)) { //Não tem esse cliente no banco então insere
            $this -> db -> insert("usuario",$cliente);
            return $this->db->insert_id();
        } else { //tem entao atualiza
            $this -> db -> where("id_usuario_sistema",$cliente['id_usuario_sistema']);
             return $this -> db -> update("usuario", $cliente);
        }
    }

    public function checkCliente($cliente)
    {
        $this->db->select("id_usuario_sistema");
        $this->db->from("usuario");
        $query = $this->db->where("id_usuario_sistema",$cliente['id_usuario_sistema']); 
        return $this->db->get()->num_rows();
    }
    
    public function inserirExercicio($exercicio)
    {
        if (!$this->checkExercico($exercicio)) {
            $this -> db -> insert("exercicio",$exercicio);
            return $this->db->insert_id();
        } else {
            $this -> db -> where("id_exercico_sistema",$exercicio['id_exercico_sistema']);
            return $this -> db -> update("exercicio", $exercicio);
        }
    }

    public function checkExercico($exercicio)
    {
        $this->db->select("id_exercico_sistema");
        $this->db->from("exercicio");
        $query = $this->db->where("id_exercico_sistema",$exercicio['id_exercico_sistema']); 
        return $this->db->get()->num_rows();
    }
    
    public function inserirMedida($medida)
    {
        if (!$this->checkMedida($medida)){
            $this -> db -> insert("medida",$medida);
            return  $this->db->insert_id();
        } else {
            $this -> db -> where("id_medida_sistema",$medida['id_medida_sistema']);
            return $this -> db -> update("medida", $medida);
        }
    }

    public function checkMedida($medida)
    {
        $this->db->select("id_medida_sistema");
        $this->db->from("medida");
        $query = $this->db->where("id_medida_sistema",$medida['id_medida_sistema']); 
        return $this->db->get()->num_rows();
    }

    public function inserirTreino($treino)
    {
        if (!$this->checkTreino($treino)){
            $this -> db -> insert("treino_cliente",$treino);
            return  $this->db->insert_id();
        } else {
            $this -> db -> where("id_treino_sistema",$treino['id_treino_sistema']);
            return  $this -> db -> update("treino_cliente", $treino);
        }
    }

    public function checkTreino($treino)
    {
        $this->db->select("id_treino_sistema");
        $this->db->from("treino_cliente");
        $query = $this->db->where("id_treino_sistema",$treino['id_treino_sistema']); 
        return $this->db->get()->num_rows();
    }
}