<?php require_once 'views/layout/cabeceraLogo.php';?>
<?php 
//Utls::deleteSession("gastoRegistro");
$sesion = ""; 
if(isset($_SESSION["gastoRegistro"])){$sesion = $_SESSION['gastoRegistro']['datos'];} ?>
<div class="row mb-5">
    <div class="col-12 col-lg-6 col-xl">
        <div class="card border-success" style="background-color: #F8F9FA;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted mb-2">
                            Total Entrada Caja
                        </h6>
                        <span class="h2 mb-0">
                            $ <?=$totalDinero?>
                        </span>
                    </div>
                    <div class="col-auto">
                        <!-- <span class="h2 fe fe-dollar-sign text-muted mb-0"></span> -->
                        <i class="far fa-money-bill-alt text-muted mb-0"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl">
        <div class="card border-danger" style="background-color: #F8F9FA;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted mb-2">
                            Total Gastos
                        </h6>
                        <span class="h2 mb-0">
                            $<?=$totalGasto?>
                        </span>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl">
        <div class="card border-success" style="background-color: #F8F9FA;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted mb-2">
                            Queda En Caja
                        </h6>
                        <span class="h2 mb-0">
                            $<?=$totalQuedaDinero?>
                        </span>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mb-5">
    <form class="col-md-12" id="restaDinero" action="<?=base_url?>Consultorio/registrarGasto" method="POST" novalidate>
        <div class="form-row col-md-12">
            <div class="form-group col-md-6">
                <label for="dineroAtomar">Cantidad</label>
                <input type="hidden" id="quedaDinero" name="queda" value="<?=$totalQuedaDinero?>">
                <input type="number" class="form-control" name="gasto" id="dineroAtomar" placeholder="0.00" value="<?php if($sesion != "") echo $sesion["Cantidad"];?>">
                <div class="" id="alertadineroAtomar"></div>
            </div>
            <div class="form-group col-md-6">
                <label for="motivoGasto">Motivo</label>
                <input type="text" class="form-control" name="motivo" id="motivoGasto" placeholder="pago de..." value="<?php if($sesion != "") echo $sesion["motivo"];?>">
                <div class="" id="alertaMotivo"></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="enviarDatos">Registrar</button>
        <?php if($sesion != ""): ?>
        <div class="alert alert-danger mt-3" role="alert"><?=$_SESSION['gastoRegistro']["error"]?></div>
        <?php endif ?>
    </form>
</div>