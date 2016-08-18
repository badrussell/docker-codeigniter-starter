<?php

class Backup extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->library('email');
        $this->load->config('email');
        $this->email->initialize($this->config->item('email'));
    }

    public function index()
    {

        $backup =& $this->dbutil->backup();

        $db_name = date("Y-m-d-H-i-s") .'.zip';

        $save = "uploads/backups/{$db_name}";

        write_file($save, $backup);

        $this->send($save);
    }

    public function send($arquivo)
    {

        $this->email->from('postmaster@sandbox531b71b233e64a19be924aa42c47658a.mailgun.org', '[ CARLOS ]');
        $this->email->to('secretarias@bemadvogados.com.br');
        $this->email->subject('BACKUP - ARQUIVOS');

        $this->email->message("BACKUP DO BANCO DE DADOS");

        $this->email->attach("{$arquivo}");

        if ($this->email->send()) {
            echo "ENVIADO";
        } else {
            echo $this->email->print_debugger();
            die;
        }


    }

}
