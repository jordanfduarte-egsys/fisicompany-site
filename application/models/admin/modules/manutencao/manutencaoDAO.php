<?php
class ManutencaoDAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function consultaImagem($imagem,$modulo)
    {
        $sql = "SHOW COLUMNS FROM ".$modulo;
        $colunas = $this->db->query($sql);

        foreach($colunas->result() as $coluna) {
            if (in_array("imagem", get_object_vars($coluna))) {
                $this->db->select("*");
                $this->db->from($modulo);
                $this->db->where("imagem = '".$imagem."'");
                return $this->db->get()->result();
            } elseif (in_array("imagem_principal", get_object_vars($coluna))) {
                $this->db->select("*");
                $this->db->from($modulo);
                $this->db->join($modulo."_imagem", $modulo."_imagem.id_".$modulo." = ".$modulo.".id_".$modulo);
                $this->db->where($modulo."_imagem.imagem = '".$imagem."'");
                return $this->db->get()->result();
            }
        }
    }
}
