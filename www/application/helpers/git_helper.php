<?php

/**
 * Mostra o branch atual sendo utilizado pelo sistema
 *
 * @author Carlos Smolareck <carlos@vertigocv.com.br>
 */
function gitNomeBranchAtual()
{
    return implode('/', array_slice(explode('/', file_get_contents('.git/HEAD')), 2));
}
