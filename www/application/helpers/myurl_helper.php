<?php

/**
 * Retorna o nome da classe sendo utilizada
 */
function urlClassName()
{
    $ci = &get_instance();

    return $ci->router->class;
}

/**
 * Retorna o nome do metodo sendo utilizado
 */
function urlMethodName()
{
    $ci = &get_instance();

    return $ci->router->method;
}

/**
 * Retorna a view do metodo
 */
function urlGetView()
{
    return urlClassName() . '_' . urlMethodName();
}

/**
 * Retorna a url da home
 */
function urlDashboard()
{
    return base_url() . 'dashboard';
}

/**
 * Retorna a url de logout
 */
function urlLogout()
{
    return base_url() . 'logout';
}

/**
 * Retorna a url corrente
 */
function urlCurrentPage()
{
    $ci = &get_instance();

    return $ci->config->site_url() . $ci->uri->uri_string();
}

function urlPagination()
{
    return base_url() . urlClassName() . DS . urlMethodName();
}

function urlAdd()
{
    $ci = &get_instance();

    $actions = array('add', 'edit');

    if (in_array($ci->uri->segment(3), $actions)) {
        return true;
    }
}

function urlActions($id = null)
{
    $ci = &get_instance();

    $data = array('id' => $id);

    $ci->load->view('actions', $data);
}

function urlRedirectToActualMethod()
{
    return urlModuleName() . DS . urlReturnNameMethod();
}

function urlModuleName()
{
    $ci = &get_instance();

    return base_url() . $ci->uri->segment(1);
}

/**
 * Retorna o metodo sendo utiilizado
 */
function urlReturnNameMethod()
{
    $ci = &get_instance();

    return $ci->router->fetch_method();
}

/**
 * Retorna o path até a classe
 */
function urlPathClass()
{
    $ci = &get_instance();

    return urlModuleName() . DS . $ci->uri->segment(2);
}

/**
 * Retorna somente até o módulo
 */
function urlPathToAjax()
{
    return urlModuleName();
}

/**
 * Retorna o path para uma partial
 * Por default é o nome do controller_partial.php
 */
function urlGetPartial()
{
    return urlClassName() . DS . urlClassName() . '_partial';
}

function urlTotalSegments()
{
    $ci = &get_instance();

    return $ci->uri->total_segments();
}

function urlBreadcrumb($nomeSegmento = null)
{
    $url = null;
    $link = null;

    $ci = &get_instance();

    $x = 1;
    while ($x <= urlTotalSegments()) {
        $link .= $ci->uri->segment($x) . DS;
        $url[$ci->uri->segment($x)] = $link;

        if (($x == urlTotalSegments()) and (!is_null($nomeSegmento))) {
            $data['ultimoSegmento'] = $nomeSegmento;
        }

        $data['url'] = $url;

        $x++;
    }

    $ci->load->view('components/breadcrumb', $data);
}

function urlNomePrograma()
{
    $ci = &get_instance();

    $urlPrograma = $ci->uri->segment(2);

    if (isset($urlPrograma)) {
        return $ci->db->select('nomeExibicao')
            ->from('Programas')
            ->where('nome', $urlPrograma)
            ->get()
            ->row()->nomeExibicao;
    }

    return $urlPrograma;
}

/**
 * Retorna a view do metodo
 */
function urlGetViewFiltros()
{
    return urlModule() . DS . urlClassName() . DS . urlClassName() . '_filtro';
}

function urlModule()
{
    $ci = &get_instance();

    return $ci->uri->segment(1);
}