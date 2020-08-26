<div class="card border-0 shadow my-2">
	<div class="card-body p-5">
		<?php 
		require_once 'views/layout/editarNavs.php';
		require_once 'views/layout/cabeceraLogo.php';
		$sesion = ""; 
		 if(isset($_SESSION['formulario'])){$sesion = $_SESSION['formulario']['datos'];} 
		 ?>
		<div class="texcto">
			<?php if($sesion != "") echo '<p class="alert alert-danger error" role="alert">'.$_SESSION['formulario']["error"]."</p>";
			 if(isset($_SESSION['statusSave'])) echo '<p class="alert alert-success error" role="alert">'.$_SESSION['statusSave']."</p>";
			 Utls::deleteSession('statusSave');
			 ?>
		</div>
		<div class="tab-content" id="nav-tabContent" style="height: auto">
			<form id="registro" action="<?=base_url?>Paciente/editarPaciente" method="POST" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
<!-- :::::::::::::::::::::::::::::::::datos mujeres:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
<div class="page-header titulo_mujeres"><small>DATOS MUJER</small></div>
				<hr>
				<div class="form-row col-md-12" id="mujeres">
					<div class="form-group col-md-3">
						<label for="unputEmbarazos">Numero de Embarazos</label>
						<input type="number" class="form-control hideOn" name="embarazos" id="unputEmbarazos" max="10">
					</div>
					<div class="form-group col-md-3">
						<label for="inputNacidosTermino">Nacidos al termino</label>
						<input type="number" class="form-control hideOn" name="namcidosTermino" id="inputNacidosTermino">
					</div>
					<div class="form-group col-md-3">
						<label for="inputNacidosPre">Nacidos al pretermino</label>
						<input type="number" class="form-control hideOn" name="nacidosPretermino" id="inputNacidosPre">
					</div>
					<div class="form-group col-md-3">
						<label for="inputultimoEmbarazo">Fecha del ultimo parto</label>
						<input type="date" class="form-control hideOn" name="ultimoEmbarazo" id="inputultimoEmbarazo">
					</div>
				</div>
				<div class="form-row col-md-12" id="mujeres">
					<div class="form-group col-md-4">
						<label for="unputregla">Fecha de ultima regla</label>
						<input type="date" class="form-control hideOn" name="regla" id="unputregla" max="10">
					</div>
					<div class="form-group col-md-4">
						<label for="inputMedotoAnticonceptivo">Metodo Anticonceptivo actual</label>
						<input type="text" class="form-control hideOn" name="MedotoAnticonceptivo" id="MedotoAnticonceptivo">
					</div>
					<div class="form-group col-md-4">
						
					</div>
				</div>
				<input type="submit" class="btn btn-primary" id="btn-env" values="enviar" name="enviar">
			</form>
		</div>
	</div>
</div>

