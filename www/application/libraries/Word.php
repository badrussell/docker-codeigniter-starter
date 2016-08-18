<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Word
{
    public function gerar($html, $nome = 'file.docx', $destino = null ) {
        if (!$destino):
            header('Content-type: application/vnd.ms-word');
            header('Content-type: application/force-download');
            header('Content-Disposition: attachment; filename="' . $nome . '"');
            header('Pragma: no-cache');
            echo $html;
        else:
            file_put_contents($destino.'/'.$nome, $html);
        endif;
    }

}
