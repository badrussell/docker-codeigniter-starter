<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class UsuarioLogado
{

    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function getId()
    {
        return $this->ci->session->userdata('id');
    }

    public function getNome()
    {
        return $this->ci->session->userdata('nome');
    }

    public function getEmail()
    {
        return $this->ci->session->userdata('email');
    }

}
