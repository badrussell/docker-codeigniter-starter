<?php

/**
 * Verifica se o diretório contendo os logs tem permissão para leitura
 *
 * @param string $directory
 * @return boolean
 */
function directoryTestPermission($directory)
{
    if (is_readable($directory)) {
        return true;
    } else {
        return false;
    }
}
