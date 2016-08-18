<?php

class Acoes extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('acoes_model', 'acoes');
    }

    public function index()
    {

        $this->template->load('template', 'acoes/index', ['registros' => $this->acoes->getAll()]);

    }

    public function add()
    {
        $data = array();

        if ($this->input->post()) {
            if ($this->acoes->run_validation()) {

                $this->acoes->save();

                redirect(urlPathClass());
            } else {
                $data['error'] = validation_errors();
            }
        }

        $this->template->load('template', 'acoes/add', $data);
    }

    public function edit($id)
    {
        $data = array();

        if ($this->acoes->run_validation()) {
            $this->acoes->save($id);

            redirect(urlPathClass());
        } else {
            $data['error'] = validation_errors();
        }

        $data['registro'] = $this->acoes->get_by_id($id);

        $this->template->load('template', 'acoes/edit', $data);
    }

}
