<?php

class HookPreController extends MX_Controller
{

    public function login()
    {
        $this->load->model('login/login_model');

        if ($this->uri->segment(1) != 'login' and $this->uri->segment(1) != '' and $this->uri->segment(1) != 'sobre') {
            if (!$this->usuariologado->getId() and ! $this->usuariologado->getIdCliente()) {
                redirect(base_url());
            }
        }
    }

    public function checkValidInstance()
    {
        if ($this->usuariologado->getId() && !in_array($this->uri->segment(1), array('login', 'portal'))) {
            if (!$this->multipleinstancehandler->instanceExists($this->session->userdata('hash'))) {
                redirect('login/logout');
            }
        }
    }

    public function permissaoAcesso()
    {
        if ($this->usuariologado->getId()) {
            $urlLimpas = array(
                'login',
                'dashboard',
                'profiles',
                'backup',
                'sobre',
            );

            if (in_array('admin', $this->usuariologado->getGroups())) {
                $urlLimpas[] = 'configuracoes';
            }

            $modulo   = $this->uri->segment(1);
            $programa = $this->uri->segment(2);

            if (!in_array($modulo, $urlLimpas)) {
                if (!$this->usuariologado->temPermissaoPrograma($programa)) {
                    redirect('dashboard');
                }
            }
        }
    }

}
