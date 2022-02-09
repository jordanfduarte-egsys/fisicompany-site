<?php
class TreinoDAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function consultar($data = array())
    { 
        $this->db->select("*, categoria.nome as categoria_nome, dia.nome as dia_nome")->from("treino");
        $this->db->join("usuario","usuario.id_usuario = treino.id_usuario","INNER");
        $this->db->join("categoria","categoria.id_categoria = treino.id_categoria","INNER");
        $this->db->join("treino_dia","treino_dia.id_treino = treino.id_treino");
        $this->db->join("dia","dia.id_dia = treino_dia.id_dia");
        $this->db->where("usuario.id_usuario",$data['id_usuario_logado']);
        
        if(array_key_exists("dia", $data)) {
            $this->db->where("treino_dia.id_dia",$data["dia"]);
        }

        $this->db->order_by("treino.id_treino","asc");
        $this->db->order_by("dia.id_dia","asc");
        $treino_exercicio = $this->db->get()->result();
        
        foreach ($treino_exercicio as $i => $treino) {
            if (isset($treino_exercicio[$i-1]) and $treino->id_treino == $treino_exercicio[$i-1]->id_treino) {
                unset($treino_exercicio[$i]);
                continue;
            }
            
            $this->db->select("*, exercicio.nome as exercicio_nome")
                ->from("exercicio")
                ->join("treino_exercicios","exercicio.id_exercicio = treino_exercicios.id_exercicio","LEFT")
                ->where("id_categoria",$treino->id_categoria)
                ->order_by("exercicio.id_exercicio = treino_exercicios.id_exercicio","DESC");

            $treino_exercicio[$i]->exercicios = $this->db->get()->result();
            $treino_exercicio[$i]->dias = $this->db
                ->select("*")
                ->from("treino_dia")
                ->join("dia","dia.id_dia = treino_dia.id_dia")
                ->where("id_treino",$treino->id_treino)
                ->get()
                ->result();

            $treino_exercicio[$i]->exercicios_selecionados = $this->db->select("id_exercicio")
                ->from("treino_exercicios")
                ->where("id_treino",$treino->id_treino)
                ->get()
                ->result();

            $treino_exercicio[$i]->exercicios_selecionados_array = array();
            foreach ($treino_exercicio[$i]->exercicios_selecionados as $exerc) {
                $treino_exercicio[$i]->exercicios_selecionados_array[] = $exerc->id_exercicio;
           } 
        }

        return array_values($treino_exercicio);
    }
}
