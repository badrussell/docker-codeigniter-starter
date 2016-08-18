<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ajusteimagens
{
    public function __construct()
    {
          include 'wideimage/lib/WideImage.php';
    }

    public function ajusta()
    {
          $path = "upload/fotos/";
          $diretorio = dir($path);
          while($arquivo = $diretorio -> read()){
               if($arquivo != "." && $arquivo != ".."){
                     WideImage::load($path.$arquivo)->resize(800)->saveToFile($path.$arquivo, 80, 100);
               }
          }

          $diretorio -> close();
    }

}
