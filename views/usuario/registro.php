<div class="card border-0 shadow my-2">
	<div class="card-body p-5">
		<figure>    
			<img src="<?=base_url?>assets/img/logo.png" class="text-center" alt="logo salud y bienestar">
			<figcaption>
				<h2 class="font-weight-light"><p>Hoja Clinica</p></h2> 
			</figcaption> 			
		</figure>
		<div class="texcto">	
			<p class="lead">ESTE FORMATO DEBE SER LLENADO POR EL PACIENTE</p>
		</div>
		<div style="height: auto">
			<form>	
			<div class="page-header"><small>DATOS PERSONALES</small></div>
			<hr>			
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="intputname">Nombre</label>
						<input type="text" class="form-control" id="intputname">
					</div>
					<div class="form-group col-md-4">
						<label for="inputAppat">Apellido Paterno</label>
						<input type="text" class="form-control" id="inputAppat">
					</div>
					<div class="form-group col-md-4">
						<label for="inputApmat">Apellido Materno</label>
						<input type="text" class="form-control" id="inputApmat">
					</div>
				</div>
				<div class="form-row " id="form-row-sexo">
					<div class="form-control col-md-4 genero">
					<label for="intputSexo" id="intputSexo">SEXO</label>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
						  <label class="custom-control-label" for="customRadioInline1">hombre</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
						  <label class="custom-control-label" for="customRadioInline2">mujer</label>
						</div>
					</div>
					<div class="form-group col-md-4">
						<label for="inpuFechaNac">Fecha Nacimiento</label>
						<input type="text" class="form-control" id="inpuFechaNac">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuEdad">Edad</label>
						<input type="text" class="form-control" id="inpuEdad">
					</div>
				</div>
				<div class="form-row " id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="inpuEstatura">Estatura Aprox.</label>
						<input type="text" class="form-control" id="inpuEstatura">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuOcupacion">Ocupacion</label>
						<input type="text" class="form-control" id="inpuOcupacion">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuEstadoCivil">Estado Civil</label>
						<input type="text" class="form-control" id="inpuEstadoCivil">
					</div>
				</div>
				<div class="page-header"><small>DATOS CONTACTO</small></div>
				<hr>
				<div class="form-row " id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="inpuCelular">Celular</label>
						<input type="text" class="form-control" id="inpuCelular">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuCorreo">Correo</label>
						<input type="text" class="form-control" id="inpuCorreo">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuRedSocial">Red Social</label>
						<input type="text" class="form-control" id="inpuRedSocial">
					</div>
				</div>
				<div class="page-header"><small>DATOS DOMICILIO</small></div>
				<hr>
				<div class="form-row " id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="inpuEstado">Estado</label>
						<select class="form-control" name="select">
						  <option value="value1" selected>Estado 1</option> 
						  <option value="value2">Estado 2</option>
						  <option value="value3">Estado 3</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="inpuMunicipio">Municipio</label>
					    <select class="form-control" id="inpuMunicipio" name="select">
					      <option>1</option>
					      <option>2</option>
					      <option>3</option>
					      <option>4</option>
					      <option>5</option>
					    </select>
					</div>
					<div class="form-group col-md-4">
						<label for="inpuCP">CP.</label>
						<input type="text" class="form-control" id="inpuCP">
					</div>
				</div>
				<div class="form-row " id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="inpuColonia">Colonia</label>
						<input type="text" class="form-control" id="inpuColonia">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuCalle">Calle</label>
						<input type="text" class="form-control" id="inpuCalle">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuNumCasa">Num Casa</label>
						<input type="text" class="form-control" id="inpuNumCasa">
					</div>
				</div>
				<div class="page-header"><small>DATOS EMERGENCIA</small></div>
				<hr>
				<div class="form-row" id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="inpuTelEmergencia">Tel. Emergencia</label>
						<input type="text" class="form-control" id="inpuTelEmergencia">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuParentesco">Parentesco</label>
						<input type="text" class="form-control" id="inpuParentesco">
					</div>
				</div>
				<div class="page-header"><small>DATOS EXTRA</small></div>
				<hr>
				<div class="form-row " id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="inpuTelNombreRecomienda">Nombre Recomienda</label>
						<input type="text" class="form-control" id="inpuNombreRecomienda">
					</div>
					<div class="form-group col-md-8">
						<label for="inpuMotivo">Motivo</label>
						<input type="text" class="form-control" id="inpuMotivo">
					</div>
				</div>
				<div class="page-header"><small>DATOS MEDICACION</small></div>
				<hr>
				<div class="form-row " id="form-row-sexo">
					<div class="form-group col-md-4">
						<label for="selectMedicamento">Algún Medicamento Que Toma Actualmente</label>
						<select class="form-control" id="selectMedicamento" name="select">
					      <option>Si</option>
					      <option selected>No</option>
					    </select>
					</div>

					<div class="form-group col-md-4">
						<label for="inputNombreMedicamento">Nombre Medicamento</label>
						<input type="text" class="form-control" id="inputNombreMedicamento">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

