<?php require_once 'views/layout/cabeceraLogo.php' ?>

<table class="table table-hover display newPaciente " id="newPaciente">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NOMBRE </th>
      <th scope="col">Tipo </th>
      <th scope="col">Status</th>
      <th scope="col">ACCION</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $tipo = 0;$stats = 0;$id = "";
  while($nuevo = $doctores->fetch_object()):
    $id = SED::encryption($nuevo->idUsuarioDoctor);
    if($nuevo->tipoUsuarioDoctor == 2){$tipo = "Usuario";}elseif($nuevo->tipoUsuarioDoctor == 3){$tipo = "Administrador";}
    switch ($nuevo->statusUsuarioDoctor) {
        case '1':
            $stats = "Activo";
            break;
        case '2':
            $stats = "InActivo";
            break;
        case '3':
            $stats = "Vacaciones";
            break;
        default:
            $stats = "Sin Status";
            break;
    }
  ?>
            <tr>
              <th scope="row"><?=$nuevo->idUsuarioDoctor?></th>
              <td><?=SED::decryption($nuevo->nombreUsuarioDoctor).' '.SED::decryption($nuevo->apPUsuarioDoctor).' '.SED::decryption($nuevo->apMUsuarioDoctor)?></td>
              <td><?=$tipo?></td>
              <td><?=$stats?></td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="<?=base_url?>Doctor/editar&id=<?=$id?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="EDITAR"><i class="fas fa-user-edit" aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
    <?php endwhile;?>
  </tbody>
</table>