<?php

class Login_model extends  Response_Model
{

    public $table       = "usuarios";
    public $primary_key = "id";

    public function validateLogin($email, $senha)
    {
        $this->db->where('email', $email);
        $this->db->where('senha', sha1($senha));
        $this->db->where('status', 1);

        return $this->db->get($this->table)->row();
    }

}
