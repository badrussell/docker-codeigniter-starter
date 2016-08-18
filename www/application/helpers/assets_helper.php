<?php

function assetsBootstrapVersion()
{
    $ci = &get_instance();

    return $ci->config->item('bootstrap');
}

function assetsFontAwesomeVersion()
{
    $ci = &get_instance();

    return $ci->config->item('awesome');
}

function statusDevolucao($registro)
{

    $class = "";

    if ($registro->status == 1) {

        $dataPronta = date('Y-m-d', strtotime("+{$registro->dias_vencimento} days", strtotime($registro->data)));

        if ($dataPronta < date("Y-m-d")) {
            $class = "danger";
        }

    }

    return $class;

}
