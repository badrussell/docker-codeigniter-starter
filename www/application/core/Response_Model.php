<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Response_Model extends MY_Model
{

    public function getBy($fieldName, $value)
    {
        return $this->where($fieldName, $value)->get()->row();
    }

    public function getAll(array $filtros = null)
    {
        if (!empty($filtros)) {
            foreach ($filtros as $key => $value) {
                $this->where($key, $value);
            }
        }
        return $this->db->get($this->table)->result();
    }

    public function deleteBy($fieldName, $value)
    {
        $this->db->where($fieldName, $value);
        $this->db->delete($this->table);
        return ($this->db->affected_rows() > 0);
    }

    public function count_all($table = null)
    {
        if(empty($table)){
            $table = $this->table;
        }

        return $this->db->count_all($table);
    }

    public function retrieveData($sortField, $sortOrder, $offset = 0, $maxRows = 150)
    {
        if ($this->session->userdata(urlClassName() . '_filtro')) {
            foreach ($this->session->userdata(urlClassName() . '_filtro') as $campo => $valor) {
                $this->db->where($campo, $valor);
            }
        }

        $query = $this->db->order_by($sortField, $sortOrder)
                ->get($this->table, $maxRows, $offset);


        return array(
            'count' => $this->count_all($this->table),
            'data' => $query,
        );
    }

    public function getWhere($sortField, $sortOrder, $where = array(), $offset = 0, $maxRows = 150)
    {
        if (count($where) > 0) {
            $this->db->where($where);
        }

        $query = $this->db->order_by($sortField, $sortOrder)
                ->get($this->table, $maxRows, $offset);

        return array(
            'count' => $this->count_all($this->table),
            'data' => $query,
        );
    }

    public function beginTransaction()
    {
        $this->db->trans_start();
    }

    public function roolBack(){
        $this->db->trans_rollback();
    }

    public function finishTransaction()
    {
        $this->db->trans_complete();
    }

}
