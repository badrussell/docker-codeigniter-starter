<?php

function numeroParaExibicao($valor, $decimals = 2)
{
    return number_format($valor, $decimals, ',', '.');
}

function numeroParaGravacao($valor, $decimals = 2)
{
    $val = str_replace(".", "", $valor);
    return str_replace(",", ".", $val);
}

?>
