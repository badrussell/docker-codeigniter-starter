<?php

class Acoes_model extends Response_Model
{

    public $table = "acoes";
    public $primary_key = "acoes.id";

    public function validation_rules()
    {
        return array(
            'nome' => array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|trim|xss_clean'
            ),
            'status' => array(
                'field' => 'status',
                'label' => 'status',
                'rules' => 'trim|xss_clean'
            )
        );
    }

    public function db_array()
    {
        $dbarray = parent::db_array();

        if (!array_key_exists('status', $dbarray)) {
            $dbarray['status'] = 0;
        }
        return $dbarray;
    }


    public function getAll(array $filtros = null)
    {
        if (!empty($filtros)) {
            foreach ($filtros as $key => $value) {
                $this->where($key, $value);
            }
        }

        $this->db->order_by("nome", "ASC");

        return $this->db->get($this->table)->result();
    }
}
