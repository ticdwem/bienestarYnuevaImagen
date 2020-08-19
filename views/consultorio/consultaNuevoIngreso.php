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
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Recomendado Por:</label>
            <input type="text" class="form-control" value="<?=ucwords(SED::decryption($datos->nombreRecomiendaCliente))?>" id="disabledTextInput" disabled>
            </div>
            <div class="form-group col-md-6">
            <label for="cobro">Cobro</label>
            <input type="number" class="form-control" id="cobro">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txtNumber">Estatura</label>
                <input type="number" class="form-control" id="txtNumber" min="1" max="2.50">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">REGISTRAR</button>
</form>
</div>
