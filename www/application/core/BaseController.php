<?php

class BaseController extends MX_Controller
{

    public $stringRetrieve = null;
    public $file           = null;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('myurl', 'directory', 'dump', 'file', 'date', 'directory'));
        $this->load->library(array('table', 'pagination'));
    }

    public function view($module, $params = array())
    {
        $this->load->view('partials/header');
        $this->load->view($module, $params);
        $this->load->view('partials/footer');
    }

    public function setPagination($totalRows)
    {
        $config['base_url']   = urlPagination();
        $config['total_rows'] = count($totalRows);
        $config['per_page']   = 12;

        $this->config->load('pagination');

        $this->pagination->initialize($config);

        return $config['per_page'];
    }

}
