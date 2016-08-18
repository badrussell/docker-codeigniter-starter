<?php foreach ($registros as $registro): ?>
    <tr>
        <td><?php echo $registro->id ?></td>
        <td><?php echo $registro->nome ?></td>
        <td><?php echo $registro->status ?></td>
        <td>
            <a href="<?php echo urlPathClass() ?>/edit/<?php echo $registro->id ?>" title="Editar"><span class="fa fa-pencil"></span></a>
         </td>
    </tr>
<?php endforeach; ?>
