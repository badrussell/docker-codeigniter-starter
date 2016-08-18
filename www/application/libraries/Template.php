<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template
{

    var $template_data = array();

    function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    function load($template = '', $view = '', $view_data = array(), $return = FALSE)
    {
        $this->CI = &get_instance();

        if($template == 'template'){

            if($this->CI->session->userdata('id')  <= 0){
                if($template == 'template'){
                    redirect(base_url('login'));
                }else{
                    redirect(base_url('areadocliente/login'));
                }

            }

        }

        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));

        return $this->CI->load->view($template, $this->template_data, $return);
    }

}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */