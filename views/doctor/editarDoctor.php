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
			<form id="registroDoctor" action="<?=base_url?>Doctor/save" method="POST">	
                <div class="page-header"><small>DATOS PERSONALES</small></div>
                <hr>			
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="intputnameDoctor">Nombre</label>
						<input type="text" class="form-control" id="intputnameDoctor" name="intputnameDoctor" value="<?php if($sesion != ""){echo $sesion["Nombre"];}else{echo SED::decryption($datos->nombreUsuarioDoctor);}?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inputAppatDoctor">Apellido Paterno</label>
						<input type="text" class="form-control" id="inputAppatDoctor" name="inputAppatDoctor" value="<?php  if($sesion != ""){echo $sesion["Apellido_Pat"];}else{echo SED::decryption($datos->apPUsuarioDoctor);}?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inputApmatDoctor">Apellido Materno</label>
						<input type="text" class="form-control" id="inputApmatDoctor" name="inputApmatDoctor" value="<?php  if($sesion != ""){echo $sesion["Apellido_Mat"];}else{echo SED::decryption($datos->apMUsuarioDoctor);}?>">
					</div>
				</div>
				<div class="form-row ">
					<div class="form-control col-md-4 genero">
					    <label for="intputSexo" id="intputSexo">SEXO</label>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline1" name="customRadioSexoDoctor"  value="hombre" <?php if($datos->sexoUsuarioDoctor == 'hombre'){echo 'checked';}?>>
						  <label  for="customRadioInline1">hombre</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline2" name="customRadioSexoDoctor"  value="mujer" <?php if($datos->sexoUsuarioDoctor == 'mujer'){echo 'checked';}?>>
						  <label  for="customRadioInline2">mujer</label>
                        </div>                        
                    </div>
                    <div class="form-group col-md-4">
						<label for="inpuCorreoDoctor">Correo</label>
						<input type="text" class="form-control" id="inpuCorreoDoctor" name="inpuCorreoDoctor" value="<?php  if($sesion != ""){echo $sesion["correo"];}else{echo $datos->emailUsuarioDoctor;}?>">
						<div id="error" class=""></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipoUserDoctor">Tipo Usuario</label>
                        <select class="form-control" id="tipoUserDoctor" name="tipoUserDoctor">
                        <option value="" >Tipo Usuriario</option><!--tipoUsuarioDoctor-->
                        <option value="2"  <?php if($datos->tipoUsuarioDoctor == '2'){echo 'selected';}?>>Doctor</option>
                        <option value="3" <?php if($datos->tipoUsuarioDoctor == '3'){echo 'selected';}?>>Administrador</option>
                        </select>
                    </div>
				</div>
				<!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
				<input type="submit" class="btn btn-primary" id="btn-envDoctor" values="enviar" name="enviar">
			</form>
				
			<hr>
		</div>
	</div>
</div>

