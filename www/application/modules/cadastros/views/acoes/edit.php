<div class="panel panel-primary">
    <div class="panel-heading">Edição de Ações</div>

    <form action="<?php echo urlPathClass() ?>/edit/<?php echo $registro->id?>" method="post" id="form" name="frm">

        <div class="panel-body">

            <?php if (!empty($error)): ?>
                <div clas="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 alert alert-danger">
                        <?php echo $error ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" ng-model="nome" ng-init="nome = '<?php echo $registro->nome ?>'"  required>
                    <span class="required" ng-show="frm.nome.$dirty && frm.nome.$error.required">Campo Obrigatório!</span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                    <label for="status">Status</label><br>
                    <input type="checkbox" name="status" id="status" value="1" <?php echo  $registro->status == 1 ? "checked='checked'" : FALSE?> >
                </div>


                <div clas="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php $this->load->view('toolbar', array("tipoToolbar" => "registro")); ?>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
