<?php

function removerAcentos($str)
{
    $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ&ºª";
    $to = "aaaaeeiooouucAAAAEEIOOOUUC   ";

    $keys = array();
    $values = array();
    preg_match_all('/./u', $from, $keys);
    preg_match_all('/./u', $to, $values);
    $mapping = array_combine($keys[0], $values[0]);
    return strtr($str, $mapping);
}

function somenteNumeros($str)
{
    return preg_replace("/\D+/", "", $str);
}

function removeBarrasHifens($str)
{
    return str_replace(array(',', '-', '/', '\\', '.'), '', $str);
}

function converterParaMaiusculas($term)
{
    return strtr(strtoupper($term), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
}
