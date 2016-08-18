<?php
function numeroMaximoContato()
{
    $ci = &get_instance();
    return $ci->db->query("SELECT valor FROM configuracoes where chave = 'numeroMaximoContato'")->row()->valor;
}
