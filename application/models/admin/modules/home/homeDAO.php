<?php
class HomeDAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function montaQueryBusca($class, $busca, $controller)
    {
        $this->db->select("*");
        $this->db->from($controller);
        $i = 0;
        foreach($class as $nome => $value):
            
            //Restricoes
            if($nome == "permissao_modulo" or $nome == "senhaconf")
                continue;
            if ($i == 0) {
                $this->db->like($nome, $busca);
            } else {
                $this->db->or_like($nome, $busca);
            }
            
            $i++;
        endforeach;
        
        return $this->db->get()->result();
    }
}
