<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Uname Development Team
 *
 * @package	Uname Development Team
 * @copyright	Copyright (c) 2012 - 2013 Uname Development Team
 * @link	http://uname.com.br
 *
 */
if (!function_exists('create_pdf')) {

    /**
     * Gerar PDF
     *
     * @param  String $html_data View que vai compor o PDF
     * @param  String $file_name Nome do arquivo
     */
    function create_pdf($html_data, $file_name = "")
    {
        if ($file_name == "") {
            $file_name = 'meu-pdf-' . date('d-m-Y');
        }

        require_once(APPPATH . 'helpers/mpdf/mpdf.php');

        $mypdf = new mPDF();
        $mypdf->SetDisplayMode('fullpage');

        $hyphenate = new stdClass();
        $hyphenate->mypdf = true;

        $mypdf->KeepColumns = true;
        $mypdf->WriteHTML($html_data);
        $mypdf->Output($file_name . '.pdf', 'D');
    }

    /**
     * Gerar PDF com colunas
     *
     * @param  String $html_data View que vai compor o PDF
     * @param  String $file_name Nome do arquivo
     */
    function create_pdf_col($html_data, $file_name = "")
    {
        if ($file_name == "") {
            $file_name = 'meu-pdf-' . date('d-m-Y');
        }

        require_once(APPPATH . 'helpers/mpdf/mpdf.php');

        $hyphenate = new stdClass();

        $mypdf = new mPDF();
        $mypdf->SetDisplayMode('fullpage');
        $hyphenate->mypdf = true;
        $mypdf->KeepColumns = true;
        $mypdf->SetColumns(2, 'J', 5);
        $mypdf->WriteHTML($html_data);
        $mypdf->Output($file_name . '.pdf', 'D');
    }

}

function pdf_create($html, $filename, $stream = true, $textoMarcaDagua = null, $path = null, $css = null, $idEmissor = null, $orientacao = null)
{
    $arrayParams = array();

    require_once(APPPATH . 'helpers/mpdf/mpdf.php');
    $CI = &get_instance();

    $CI->load->model('comum/empresas_model', 'empresas_model');

    $paramVariaveis = 'relatorio_variaveis_padrao';
    $paramModelo = 'relatorio_modelo_padrao';

    if ($CI->session->userdata('idEmissor') != null) {
        $arrayParams = $CI->empresas_model->getParametros($CI->session->userdata('idEmissor'));
    } elseif ($idEmissor != null) {
        $arrayParams = $CI->empresas_model->getParametros($idEmissor);
    } else {
        $arrayParams = $CI->empresas_model->getParametros($CI->usuariologado->getIdEmpresa());
    }

    $mpdf = new mPDF('c', ($orientacao == 'L' ? 'A4-L' : ''), 9, 'Verdana', 18, 18, 35, 20, 0, 10, $orientacao);
    $mpdf->SetTitle($filename);
    $mpdf->SetHTMLHeader($CI->load->view('pdfHeader', null, true));
    $mpdf->SetHTMLFooter($CI->load->view('pdfFooter', null, true));

    if (!empty($css)) {
        $mpdf->WriteHTML(file_get_contents($css), 1);
    } else {
        $mpdf->WriteHTML(file_get_contents('assets/css/report.css'), 1);
    }

    if ($textoMarcaDagua != null) {
        $mpdf->SetWatermarkText($textoMarcaDagua);
        $mpdf->showWatermarkText = true;
    }

    $mpdf->WriteHTML($html, 2);
    $mpdf->SetAutoFont();

    if ($path !== '' && $path !== null) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    if ($stream) {
        $mpdf->Output($path . DS . $filename . '.pdf', 'F');
    } else {
        $mpdf->Output();
    }
}
