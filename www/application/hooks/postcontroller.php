<?php

class HookPostController extends MX_Controller
{

    public function validationDelimiters()
    {
        /* muda o delimitador de erros para mostrar via javascript depois */
        $this->form_validation->set_error_delimiters('<div>', '</div>');
    }

    public function updateInstanceLastActivity()
    {
        $this->multipleinstancehandler->refreshInstanceData($this->session->userdata('hash'));
    }

}
