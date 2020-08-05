<?= require_once 'views/layout/cabeceraLogo.php' ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NOMBRE </th>
      <th scope="col">ACCION</th>
    </tr>
  </thead>
  <tbody>
  <?php while($nuevo = $listar->fetch_object()):?>
            <tr>
            <th scope="row"><?=$nuevo->idCliente?></th>
            <td><?=$nuevo->completo?></td>
            <td><a href="<?=base_url?>Consulta/paciente&id=<?=$nuevo->idCliente?>" class="btn btn-primary">DAR CONSULTA</a></td>
            </tr>
    <?php endwhile;?>
  </tbody>
</table>