<div class="panel panel-primary list-usuarios">
    <div class="panel-heading">Listagem de ações</div>
    <div class="panel-body">

        <?php $this->load->view('toolbar', array("tipoToolbar" => "listagem")); ?>

        <table id="table" class="table table-responsive table-striped table-condensed">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php $this->load->view('partial', $registros) ?>
            </tbody>
        </table>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').dataTable();
    });
</script>