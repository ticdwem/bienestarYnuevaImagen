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
						  <input type="radio" id="customRadioInline1" name="customRadioSexo"  value="hombre">
						  <label  for="customRadioInline1">hombre</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioInline2" name="customRadioSexo"  value="mujer" >
						  <label  for="customRadioInline2">mujer</label>
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
				<input type="submit" class="btn btn-primary" id="btn-envDoctor" values="enviar" name="enviar">
			</form>
			<hr>
			<h4>PERMISOS</h4>
			<form action="<?=base_url?>Doctor/permisos" method="POST" id="frmPermisos" novalidate>
				<div class="row">
					<div class="col mb-4 border">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Paciente" disabled>
							<label class="form-check-label" for="Paciente">
								PACIENTE
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input pacientesChecks" type="checkbox" value="1" name="check[]" id="pacienteAlta">
							<label class="form-check-label" for="pacienteAlta">
								ALTA PACIENTE
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input pacientesChecks" type="checkbox" value="2" name="check[]" id="pacienteEditar">
							<label class="form-check-label" for="pacienteEditar">
								EDITAR PACIENTE
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input pacientesChecks" type="checkbox" value="3" name="check[]" id="pacienteDatos">
							<label class="form-check-label" for="pacienteDatos">
								DATOS COMPLEMENTARIOS
							</label>
						</div>
					</div>
					<div class="col mb-4 ml-2 border">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Consultorio">
							<label class="form-check-label" for="Consultorio">
								CONSULTORIO
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="4" name="check[]" id="consultorioCD">
							<label class="form-check-label" for="consultorioCD">
								CONSULTA DIARIA
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="5" name="check[]" id="consultorioLista">
							<label class="form-check-label" for="consultorioLista">
								LISTA PACIENTES
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="6" name="check[]" id="consultorioMedicmento">
							<label class="form-check-label" for="consultorioMedicmento">
								CONTROL MEDICAMENTO
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="7" name="check[]" id="consultorioNuevos">
							<label class="form-check-label" for="consultorioNuevos">
								PACIENTES NUEVOS
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="8" name="check[]" id="cosnsultorioGastos">
							<label class="form-check-label" for="cosnsultorioGastos">
								GASTOS
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="9" name="check[]" id="cosnsultorioGastos">
							<label class="form-check-label" for="cosnsultorioGastos">
								GASTOS OTROS
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="10" name="check[]" id="consultrioCorte">
							<label class="form-check-label" for="consultrioCorte">
								CORTE DIARIO
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input consultorioCheck" type="checkbox" value="11" name="check[]" id="consultorioAlta">
							<label class="form-check-label" for="consultorioAlta">
								ALTA CONSULTORIO
							</label>
						</div>
					</div>
					<div class="col mb-4 ml-2 border">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Doctor">
							<label class="form-check-label" for="Doctor">
								DOCTOR
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input doctorCheck" type="checkbox" value="12" name="check[]" id="doctorAlta">
							<label class="form-check-label" for="doctorAlta">
								ALTA DOCTOR
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input doctorCheck" type="checkbox" value="13" name="check[]" id="doctorLista">
							<label class="form-check-label" for="doctorLista">
								LISTA DOCTOR
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input doctorCheck" type="checkbox" value="14" name="check[]" id="doctorEditar">
							<label class="form-check-label" for="doctorEditar">
								EDITAR DOCTOR
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col border">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Avanzado">
							<label class="form-check-label" for="Avanzado">
								AVANZADO
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="15" name="check[]" id="avanzadoMenu">
							<label class="form-check-label" for="avanzadoMenu">
								MENU ADMINISTRATIVO
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="16" name="check[]" id="avanzadoMovimientos">
							<label class="form-check-label" for="avanzadoMovimientos">
								MOVIMIENTOS
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="17" name="check[]" id="avanzadoConsultorio">
							<label class="form-check-label" for="avanzadoConsultorio">
								LISTADO CONSULTORIO
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="18" name="check[]" id="avanzadoPaciente">
							<label class="form-check-label" for="avanzadoPaciente">
								LISTADO PACIENTE
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="19" name="check[]" id="avanzadoHistorial">
							<label class="form-check-label" for="avanzadoHistorial">
								HISTORIAL PACIENTE
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="20" name="check[]" id="avanzadoGlobal">
							<label class="form-check-label" for="avanzadoGlobal">
								REPORTE GLOBAL
							</label>
						</div>
						<div class="form-check ml-5">
							<input class="form-check-input avanzadoChecks" type="checkbox" value="21" name="check[]" id="AvanzadoGlobalEspecifico">
							<label class="form-check-label" for="AvanzadoGlobalEspecifico">
								REPORTE GLOBAL ESPECIFICO
							</label>
						</div>
					</div>
					<div class="col"></div>
					<div class="col"></div>
				</div>
				<div class="mt-4 text-left botonRegistrar">
					<button type="submit" class="btn btn-lg btn-outline-success" name="btnPermisos">REGISTRAR</button>
					<!-- <input type="submit" class="btn btn-primary" id="btn-Permisos" values="REGISTRAR" name="btnPermisos"> -->
				</div>
			</form>
		</div>
	</div>
</div>

