<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('login_model');
    }

    public function index()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|xss_clean');
            $this->form_validation->set_rules('senha', 'Senha', 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('login'));

            } else {

                $user = $this->login_model->validateLogin($this->input->post('email'), $this->input->post('senha'));

                if (empty($user)) {

                    if (empty($this->login_model->getAll(array('email' => $this->input->post('email')))[0])) {
                        $this->session->set_flashdata('error', 'Seu E-mail está incorreto');
                    }

                    if (empty($this->login_model->getAll(array('senha' => sha1($this->input->post('senha'))))[0])) {
                        $this->session->set_flashdata('error', 'Sua Senha está incorreto');
                    }

                    if (empty($this->login_model->getAll(array('senha' => sha1($this->input->post('senha'))))[0]) && empty($this->login_model->getAll(array('email' => $this->input->post('email')))[0])) {
                        $this->session->set_flashdata('error', 'Seu E-mail ou Senha está incorreto');
                    }

                    redirect(base_url('login'));

                }

                $sessionData = array(
                    'id' => $user->id,
                    'email' => $user->email,
                    'nivel' => $user->nivel,
                    'status' => $user->status,
                    'logged_in' => true
                );

                $this->session->set_userdata($sessionData);
                redirect(base_url() . 'dashboard');
            }
        } elseif ($this->session->userdata('id')) {
            redirect(base_url('dashboard'));
        } else {
            $this->load->view('login/index');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}