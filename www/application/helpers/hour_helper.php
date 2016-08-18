<?php

function horaParaExibicao($hora, $formato = "H:i")
{
    $retorno = null;

    if ($hora !== null) {
        $retorno = date($formato, strtotime($hora));
    }

    return $retorno;
}

function diffHoras($hrIni, $hrFim)
{
    $hrIni = ((int)explode(':', $hrIni)[0] * 3600) + ((int)explode(':', $hrIni)[1] * 60);
    $hrFim = ((int)explode(':', $hrFim)[0] * 3600) + ((int)explode(':', $hrFim)[1] * 60);
    if ($hrIni > $hrFim) {
        $hrFim += 86400;
    }
    $vlRet = $hrFim - $hrIni;

    return $vlRet / 3600;
}

/***
 * Tenta criar um objeto datetime a partir de uma hora
 * Se criar, significa que a hora passada por parâmetro é válida
 *
 * @param $str hora no formato hh:mm
 *
 * @return bool
 */
function criarObjetoHora($str)
{
    $valid = preg_match("/([01][0-9]|2[0-3]):[0-5][0-9]/", $str);
    $data = null;

    if ($valid) {
        $data = DateTime::createFromFormat('Y-m-d H:i', '2001-01-01 ' . $str);
    }

    return $data;
}

function horaAtual()
{
    return date('H:i');
}