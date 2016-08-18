<?php

function toolbarNovoRegistro($idBotaoAdicionar = 'btnAdicionar', $hrefNulo = false)
{
    $ci = &get_instance();
    $href = $hrefNulo ? '#' : urlPathClass() . '/add';
    $ci->toolbar->reset();
    $ci->toolbar->setToolbarBackColorClass('alert-info');
    $ci->toolbar->addAnchorButton($idBotaoAdicionar, lang('toolbar-btn-adicionar'), $href, 'btn-primary');

    return $ci->toolbar->createMarkup();
}

function toolbarSalvarRegistro($idBotaoSalvar = 'btnSalvar', $idBotaoCancelar = 'btnCancelar')
{
    $ci = &get_instance();
    $ci->toolbar->reset();
    $ci->toolbar->rightAligned();
    $ci->toolbar->addSubmitButton($idBotaoSalvar, lang('toolbar-btn-salvar'), 'btn btn-success');
    $ci->toolbar->addAnchorButton($idBotaoCancelar, lang('toolbar-btn-cancelar'), urlPathClass(), 'btn-default', 'data-dismiss="modal"');

    return $ci->toolbar->createMarkup();
}

function toolbarPesquisarLimpar($idBtnPesquisar = 'btnPesquisar', $idBtnLimpar = 'btnLimpar')
{
    $ci = &get_instance();
    $ci->toolbar->reset();
    $ci->toolbar->rightAligned();
    $ci->toolbar->addSubmitButton($idBtnPesquisar, lang('toolbar-btn-pesquisar'), 'btn-primary');
    $ci->toolbar->addAnchorButton($idBtnLimpar, lang('toolbar-btn-limpar'), urlPathClass(), 'btn-default', 'data-dismiss="modal"');

    return $ci->toolbar->createMarkup();
}

function toolbarEnviarCancelar($idBotaoEnviar = 'btnEnviar', $idBotaoCancelar = 'btnCancelar')
{
    $ci = &get_instance();
    $ci->toolbar->reset();
    $ci->toolbar->rightAligned();
    $ci->toolbar->addSubmitButton($idBotaoEnviar, lang('toolbar-btn-enviar'), 'btn-primary');
    $ci->toolbar->addAnchorButton($idBotaoCancelar, lang('toolbar-btn-cancelar'), urlPathClass(), 'btn-default', 'data-dismiss="modal"');

    return $ci->toolbar->createMarkup();
}

/**
 * Função para criar a toolbar com botão. Recebe um array de botões, sendo
 * possível criar mais de um botão na toolbar. (idBotão => labelBotão)
 * @param type $arrButtons
 * @return type
 */
function toolbarGerar($arrButtons = array())
{
    $ci = &get_instance();
    $ci->toolbar->reset();
    $ci->toolbar->setToolbarBackColorClass('alert-info');
    foreach ($arrButtons as $idBtn => $labelBtn) {
        $ci->toolbar->addSubmitButton($idBtn, $labelBtn, 'btn-primary');
    }

    return $ci->toolbar->createMarkup();
}

function toolbarNovoRegistroLabel($idBotaoAdicionar = 'btnAdicionar', $label = '', $href = '')
{
    $ci = &get_instance();
    if ($href == '') {
        $href = urlPathClass() . '/add';
    }
    if ($label == '') {
        $label = lang('toolbar-btn-adicionar');
    }
    $ci->toolbar->reset();
    $ci->toolbar->setToolbarBackColorClass('alert-info');
    $ci->toolbar->addAnchorButton($idBotaoAdicionar, $label, $href, $classes = 'btn-primary');

    return $ci->toolbar->createMarkup();
}
