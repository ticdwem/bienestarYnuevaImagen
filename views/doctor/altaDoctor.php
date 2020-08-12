<div class="card border-0 shadow my-2">
	<div class="card-body p-5">
		<?php require_once 'views/layout/cabeceraLogo.php';?>
		<?php $sesion = ""; 
         if(isset($_SESSION['formulario_doctor'])){$sesion = $_SESSION['formulario_doctor']['datos'];} ?>
		<div class="texcto">
			<?php if($sesion != "") echo '<p class="alert alert-danger error" role="alert">'.$_SESSION['formulario_doctor']["error"]."</p>";?>
			<?php if(isset($_SESSION['statusSave'])) echo '<p class="alert alert-success error" role="alert">'.$_SESSION['statusSave']."</p>";?>
			<?php Utls::deleteSession('formulario_doctor') ?>
			<?php Utls::deleteSession('statusSave') ?>
		</div>
		<div style="height: auto">
			<form id="registro" action="<?=base_url?>Doctor/save" method="POST">	
                <div class="page-header"><small>DATOS PERSONALES</small></div>
                <hr>			
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="intputname">Nombre</label>
						<input type="text" class="form-control" id="intputname" name="intputname" value="<?php if($sesion != "") echo $sesion["Nombre"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inputAppat">Apellido Paterno</label>
						<input type="text" class="form-control" id="inputAppat" name="inputAppat" value="<?php  if($sesion != "") echo $sesion["Apellido_Pat"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inputApmat">Apellido Materno</label>
						<input type="text" class="form-control" id="inputApmat" name="inputApmat" value="<?php  if($sesion != "") echo $sesion["Apellido_Mat"];?>">
					</div>
				</div>
				<div class="form-row ">
					<div class="form-control col-md-4 genero">
					    <label for="intputSexo" id="intputSexo">SEXO</label>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline1" name="customRadioSexo" class="custom-control-input"  value="hombre">
						  <label class="custom-control-label" for="customRadioInline1">hombre</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline2" name="customRadioSexo" class="custom-control-input" value="mujer" >
						  <label class="custom-control-label" for="customRadioInline2">mujer</label>
                        </div>                        
                    </div>
                    <div class="form-group col-md-4">
						<label for="inpuCorreo">Correo</label>
						<input type="text" class="form-control" id="inpuCorreo" name="inpuCorreo" value="<?php  if($sesion != "") echo $sesion["correo"];?>">
						<div id="error" class=""></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipoUser">Tipo Usuario</label>
                        <select class="form-control" id="tipoUser" name="tipoUser">
                        <option value="">Tipo Usuriario</option>
                        <option value="2">Doctor</option>
                        <option value="3">Administrador</option>
                        </select>
                    </div>
				</div>
				<!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
				<input type="submit" class="btn btn-primary" id="btn-env" values="enviar" name="enviar">
			</form>
		</div>
	</div>
</div>

