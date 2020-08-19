<?php require_once 'views/layout/cabeceraLogo.php' ?>
<!-- List group -->
<div class="pagos">
<div class="control"><?=$datos->idCliente?></div>
    <!-- Tab panes -->
    <div class="datosPaciente">
        <div class="nombrePaciente">
         <p class="name"><?php echo ucwords(SED::decryption($datos->nombreCliente).' '.SED::decryption($datos->apPatCliente).' '.SED::decryption($datos->apMatCliente))?></p>
        </div>
    </div>
    <form action="<?=base_url?>Consulta/ingreso" method="POST" id="frmCobroEstatura" novalidate>
        <input type="hidden" name="idPaciente" value="<?=$datos->idCliente?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Recomendado Por:</label>
                <input type="text" class="form-control" value="<?=ucwords(SED::decryption($datos->nombreRecomiendaCliente))?>" id="disabledTextInput" disabled>
            </div>
            <div class="form-group col-md-6">
                <label for="cobro">Cobro</label>
                <input type="number" class="form-control" id="cobro" name="txtCobro">
                <div class="" id="alertaCobro">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txtNumber">Estatura</label>
                <input type="number" class="form-control" id="txtEstatura" name="txtEstatura" value="<?=$datos->estaturaCliente?>">
                <div class="" id="alertaEstatura">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="observacion">Observaciones</label>
            <textarea class="form-control" id="observacion" name="txtObs" rows="3"></textarea>
            <div class="" id="alertaObs">
                </div>
        </div>
        <button type="submit" class="btn btn-primary" name="btnRegistro" id="btnUpdateRegistro">REGISTRAR</button>
</form>
</div>
