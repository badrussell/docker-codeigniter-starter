<?php
/*
 * Parâmetros de configuração da toolbar
 * os parâmetros class* tem por objetivo permitir a inclusão de itens no atributo class (pode incluir mais de uma class separando por espaço)
 * tipoToolbar define quais as configurações serão exibidas - default é exibir o botão para adicionar registro
 */

if (!isset($idBtnSalvar)) {
    $idBtnSalvar = 'btnSalvar';
}

if (!isset($classBtnSalvar)) {
    $classBtnSalvar = '';
}

if (!isset($idBtnCancelar)) {
    $idBtnCancelar = 'btnCancelar';
}

if (!isset($classBtnCancelar)) {
    $classBtnCancelar = '';
}

if (!isset($tipoToolbar)) {
    $tipoToolbar = '';
}

if (!isset($url)) {
    $url = urlPathClass();
}
?>

<?php if($this->session->userdata('nivel') == 1) : ?>

<?php if ($tipoToolbar == "registro"): ?>
    <div class="alert pull-right">
        <button class="btn btn-primary <?php echo $classBtnSalvar ?>" id="<?php echo $idBtnSalvar ?>" type="submit">Salvar</button>
        <a href="<?php echo $url ?>" class="btn btn-warning <?php echo $classBtnCancelar ?>" id="<?php echo $idBtnCancelar ?>">Cancelar</a>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        <a href="<?php echo urlPathClass() ?>/add" class="btn btn-primary">Adicionar</a>
    </div>
 <?php endif;

 endif;