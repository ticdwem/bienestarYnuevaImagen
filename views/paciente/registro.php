<div class="card border-0 shadow my-2">
	<div class="card-body p-5">
		<!-- <figure>    
			<img src="assets/img/logo.png" class="text-center" alt="logo salud y bienestar">
			<figcaption>
				<h2 class="font-weight-light"><p>Hoja Clinica</p></h2> 
			</figcaption> 
		</figure> -->
		<?php require_once 'views/layout/cabeceraLogo.php';?>
		<?php $sesion = ""; 
		 if(isset($_SESSION['formulario'])){$sesion = $_SESSION['formulario']['datos'];} ?>
		<div class="texcto">	
			<p class="lead">ESTE FORMATO DEBE SER LLENADO POR EL PACIENTE</p>
			<?php if($sesion != "") echo '<p class="alert alert-danger error" role="alert">'.$_SESSION['formulario']["error"]."</p>";?>
			<?php if(isset($_SESSION['statusSave'])) echo '<p class="alert alert-success error" role="alert">'.$_SESSION['statusSave']."</p>";?>
		</div>
		<div style="height: auto">
			<form id="registro" action="<?=base_url?>Paciente/save" method="POST">
			 <!-- <form action="<?=base_url?>Paciente/saveArray" method="POST"> 	--> 
				<div class="idPaciente">
				<input type="text" class="form-control" id="idPaciente" value="<?=Utls::createId(1,$id['id'])?>" readonly="true" name="idPaciente">	
				</div>	
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
						<label for="inpuFechaNac">Fecha Nacimiento</label>
						<input type="text" onchange="javascript:calcularEdad()" class="form-control" id="dateInicio" name="dateInicio" placeholder="dd/mm/yyyy">
						<!-- <span class="input-group-addon" >
                        	<input type="button"  value="Calcular"  onclick="javascript:calcularEdad();" />
                        </span> -->
					</div>
					<div class="form-group col-md-4">
						<label for="inpuEdad">Edad</label>
						<input type="text" class="form-control" id="inpuEdad" name="inpuEdad" readonly>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inpuEstatura">Estatura Aprox.</label>
						<input type="text" class="form-control" id="inpuEstatura" name="inpuEstatura" value="<?php  if($sesion != "") echo $sesion["estatura"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuOcupacion">Ocupacion</label>
						<input type="text" class="form-control" id="inpuOcupacion" name="inpuOcupacion" value="<?php  if($sesion != "") echo $sesion["ocupacion"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuEstadoCivil">Estado Civil</label>
						<select class="form-control" id="inpuEstadoCivil" name="inpuEstadoCivil">
							<option value="">ESCOGE UNA OPCION</option> 	
							<option value="CASADO">CASADO</option> 	
							<option value="DIVORCIADO">DIVORCIADO</option> 	
							<option value="SOLTERO">SOLTERO</option> 	
							<option value="VIUDO">VIUDO</option> 	
							<option value="SEPARADO">SEPARADO</option> 	
							<option value="UNIÓN LIBRE">UNIÓN LIBRE</option> 	
						</select>
					</div>
				</div>
				<div class="page-header"><small>DATOS CONTACTO</small></div>
				<hr>
				<div class="form-row ">
					<div class="form-group col-md-4">
						<label for="inpuCelular">Celular</label>
						<input type="text" class="form-control" id="inpuCelular" name="inpuCelular" value="<?php  if($sesion != "") echo $sesion["celular"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuCorreo">Correo</label>
						<input type="text" class="form-control" id="inpuCorreo" name="inpuCorreo" value="<?php  if($sesion != "") echo $sesion["correo"];?>">
						<div id="error" class=""></div>
					</div>
					<div class="form-group col-md-4">
						<label for="inpuRedSocial">Red Social</label>
						<input type="text" class="form-control" id="inpuRedSocial" name="inpuRedSocial" value="<?php  if($sesion != "") echo $sesion["red_social"];?>">
					</div>
				</div>
				<div class="page-header"><small>DATOS DOMICILIO</small></div>
				<hr>
				<div class="form-row ">
					<div class="form-group col-md-4">
						<label for="inpuEstado">Estado</label>
						<select class="form-control inpuEstado" id="inpuEstado" name="inpuEstado">
						<?php while ($estado = $nombreE->fetch_object()):?>							
							<option value="<?= $estado->id?>"><?= $estado->estado?></option> 							
						<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="inpuMunicipio">Municipio</label>
					    <select class="form-control" id="inpuMunicipio" name="inpuMunicipio">
					    </select>
					</div>
					<div class="form-group col-md-4">
						<label for="inpuCP">CP.</label>
						<input type="text" class="form-control" id="inpuCP" name="inpuCP" value="<?php  if($sesion != "") echo $sesion["codigo_postal"];?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inpuColonia">Colonia</label>
						<input type="text" class="form-control" id="inpuColonia" name="inpuColonia" value="<?php  if($sesion != "") echo $sesion["colonia"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuCalle">Calle</label>
						<input type="text" class="form-control" id="inpuCalle" name="inpuCalle" value="<?php  if($sesion != "") echo $sesion["calle"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuNumCasa">Num Casa</label>
						<input type="text" class="form-control" id="inpuNumCasa" name="inpuNumCasa" value="<?php  if($sesion != "") echo $sesion["numero_casa"];?>">
					</div>
				</div>
				<div class="page-header"><small>DATOS EMERGENCIA</small></div>
				<hr>
				<div class="form-row" >
					<div class="form-group col-md-4">
						<label for="inpuTelEmergencia">Tel. Emergencia</label>
						<input type="text" class="form-control" id="inpuTelEmergencia" name="inpuTelEmergencia" value="<?php  if($sesion != "") echo $sesion["tetefono_emergencia"];?>">
					</div>
					<div class="form-group col-md-4">
						<label for="inpuParentesco">Parentesco</label>
						<input type="text" class="form-control" id="inpuParentesco" name="inpuParentesco" value="<?php  if($sesion != "") echo $sesion["parentesco"];?>">
					</div>
				</div>
				<div class="page-header"><small>DATOS EXTRA</small></div>
				<hr>
				<div class="form-row ">
					<div class="form-group col-md-4">
						<label for="inpuTelNombreRecomienda">Nombre Recomienda</label>
						<input type="text" class="form-control" id="inpuNombreRecomienda" name="inpuNombreRecomienda" value="<?php  if($sesion != "") echo $sesion["nombre_Recomienda"];?>">
					</div>
					<div class="form-group col-md-8">
						<label for="inpuMotivo">Motivo</label>
						<input type="text" class="form-control" id="inpuMotivo" name="inpuMotivo" value="<?php  if($sesion != "") echo $sesion["motivo"];?>">
					</div>
				</div>
				<div class="page-header"><small>DATOS MEDICACION</small></div>
				<hr>
				<div class="form-row ">
					<div class="form-group col-md-4">
						<label for="selectMedicamento">Algún Medicamento Que Toma Actualmente</label>
						<select class="form-control" id="selectMedicamento" name="select">
					      <option value="1">Si</option>
					      <option value="2" selected>No</option>
					    </select>
					</div>

					<div class="form-group col-md-4" id="medicamento">
						<label for="inputNombreMedicamento">Nombre Medicamento</label>
						<input type="text" class="form-control" id="inputNombreMedicamento" name="inputNombreMedicamento">
					</div>
				</div>
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
				<div class="page-header titulo_padecimiento"><small>ANTECEDENTES HEREDOFAMILIARES (PADRES-ABUELOS-HERMANOS):</small></div>
				<hr>
				<div class="form-row col-md-12" id="parentesco">
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input parentesco" type="checkbox" value="DIABETES" id="checkDeabetes" name="deabetes[]">
			                    <label class="form-check-label" for="checkDeabetes">
			                        DIABETES
			                    </label>
						</div>
						<input type="hidden" class="form-control"  name="deabetes[]" aria-label="Small" value="0">
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">PARENTESCO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkDeabetesParentesco" name="deabetes[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check col-md-6">
							<input class="form-check-input parentesco" type="checkbox" value="HIPERTENSIÓN" id="checkHipertension" name="hipertension[]">
			                    <label class="form-check-label" for="checkHipertension">
			                        HIPERTENSIÓN
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">PARENTESCO</span>
			                  </div>
			                  <input type="hidden" class="form-control"  name="hipertension[]" aria-label="Small"  value = "0">
			                  <input type="text" class="form-control" id="checkHipertensionParentesco" name="hipertension[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check col-md-6">
							<input class="form-check-input parentesco" type="checkbox" value="Asma" id="checkAsma" name="Asma[]">
			                    <label class="form-check-label" for="checkAsma">
			                        ASMA
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">PARENTESCO</span>
			                  </div>
			                  <input type="hidden" class="form-control"  name="Asma[]" aria-label="Small"  value = "0">
			                  <input type="text" class="form-control" id="checkAsmaParntesco" name="Asma[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check col-md-6">
							<input class="form-check-input parentesco" type="checkbox" value="CÁNCER" id="checkCancer" name="cancer[]">
			                    <label class="form-check-label" for="checkCancer">
			                        CÁNCER
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">PARENTESCO</span>
			                  </div>
			                  <input type="hidden" class="form-control"  name="cancer[]" aria-label="Small"  value = "0">
			                  <input type="text" class="form-control" id="checkCancerParntesco" name="cancer[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check col-md-6">
							<input class="form-check-input parentesco" type="checkbox" value="ALERGIAS" id="checkAlergias" name="alergias[]">
			                    <label class="form-check-label" for="checkalergias">
			                        ALERGIAS
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">PARENTESCO</span>
			                  </div>
			                  <input type="hidden" class="form-control"  name="alergias[]" aria-label="Small"  value = "0">
			                  <input type="text" class="form-control" id="checkAlergiasParntesco" name="alergias[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-2">
							<input class="form-check-input parentesco" type="checkbox" value="OTROS" id="checkOtrosFamilia" name="otros[]">
			                    <label class="form-check-label" for="checkOtrosFamilia">
			                        OTROS
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm col-md-4 indique" id="otroIndique">							
								<div class="input-group-prepend hide">
				                    <span class="input-group-text" id="inputGroup-sizing-sm">INDIQUE</span>
				                </div>
				                <input type="text" class="form-control hide" name="otros[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm">       
			             </div>
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">PARENTESCO</span>
			                  </div>
			                  <input type="text" class="form-control otroIndique" aria-label="Small" name="otros[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input" type="checkbox" value="NINGUNO" id="checkNinguno" name="ninguno[]">
							<input type="hidden" class="form-control"  name="ninguno[]" aria-label="Small"  value = "0">
							<input type="hidden" class="form-control"  name="ninguno[]" aria-label="Small"  value = "0">
							<input type="hidden" class="form-control"  name="ninguno[]" aria-label="Small"  value = "0">
			                    <label class="form-check-label" for="checkNinguno">
			                        NINGUNO
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm   col-md-6">
							
						</div>
					</div>
				</div>
<!-- ::::::::::::::::::::::::::::::::::::::::padecimientos actuales:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
				<div class="page-header titulo_padecimiento"><small>ANTECEDENTES PERSONALES PATOLOGICOS:</small></div>
				<hr>
				<div class="form-row col-md-12" id="actuales">
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="DIABETES" id="checkDeabetesActual" name="actualDeabetes[]">
			                <label class="form-check-label" for="checkDeabetesActual">DIABETES</label>
						</div>
						<input type="hidden"  name="actualDeabetes[]" value="0">
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkDeabetesActualParentesco" name="actualDeabetes[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="HIPERTENSIÓN" id="checkHipertensionActual" name="actualHipertension[]">
			                <label class="form-check-label" for="checkHipertensionActual">ENFERMEDADES CARDIOVASCULAES (HIPERTENSION)</label>
						</div>
						<input type="hidden" name="actualHipertension[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkHipertensionActualParentesco" name="actualHipertension[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="ASMA" id="checkAsmaActual" name="actualAsma[]">
			                <label class="form-check-label" for="checkAsmaActual">ASMA</label>
						</div>
						<input type="hidden" name="actualAsma[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkAsmaActualParentesco" name="actualAsma[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="CÁNCER" id="checkCancerActual" name="actualCancer[]">
			                <label class="form-check-label" for="checkCancerActual">CÁNCER</label>
						</div>
						<input type="hidden" name="actualCancer[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkCancerActualParentesco" name="actualCancer[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="ALERGIAS" id="checkAlergiasActual" name="actualAlergias[]">
			                <label class="form-check-label" for="checkAlergiasActual">ALERGIAS</label>
						</div>
						<input type="hidden" name="actualAlergias[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkAlergiasActualParentesco" name="actualAlergias[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="DISLIPIDEMIAS" id="checkDislipidemiasActual" name="actualDislipidemias[]">
			                <label class="form-check-label" for="checkDislipidemiasActual">DISLIPIDEMIAS (TRIGLICEDIDOS Y COLESTEROL)</label>
						</div>
						<input type="hidden" name="actualDislipidemias[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkDislipidemiasActualParentesco" name="actualDislipidemias[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="HEPATICOS" id="checkHepaticosActual" name="actualHepaticos[]">
			                <label class="form-check-label" for="checkHepaticosActual">HEPATICOS</label>
						</div>
						<input type="hidden" name="actualHepaticos[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkHepaticosActualParentesco" name="actualHepaticos[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="RENALES" id="checkRenalesActual" name="actualRenales[]">
			                <label class="form-check-label" for="checkRenalesActual">RENALES</label>
						</div>
						<input type="hidden" name="actualRenales[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkRenalesActualParentesco" name="actualRenales[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="URINARIOS" id="checkUrinariosActual" name="actualUrinarios[]">
			                <label class="form-check-label" for="checkUrinariosActual">URINARIOS</label>
						</div>
						<input type="hidden" name="actualUrinarios[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkUrinariosActualParentesco" name="actualUrinarios[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="PROSTATA" id="checkProstataActual" name="actualProstata[]">
			                <label class="form-check-label" for="checkProstataActual">PROSTATA</label>
						</div>
						<input type="hidden" name="actualProstata[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkProstataActualParentesco" name="actualProstata[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="DISFUNSION ERECTIL" id="checkDisfusionActual" name="actualDisfusion[]">
			                <label class="form-check-label" for="checkDisfusionActual">DISFUNSION ERECTIL</label>
						</div>
						<input type="hidden" name="actualDisfusion[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkDisfusionActualParentesco" name="actualDisfusion[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="HIPOTIROIDISMO" id="checkHipotiroidismoActual" name="actualHipotiroidismo[]">
			                <label class="form-check-label" for="checkHipotiroidismoActual">HIPOTIROIDISMO</label>
						</div>
						<input type="hidden" name="actualHipotiroidismo[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkHipotiroidismoParentesco" name="actualHipotiroidismo[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="HIPERTIROIDISMO" id="checkHipertiroidismoActual" name="actualHipertiroidismo[]">
			                <label class="form-check-label" for="checkHipertiroidismoActual">HIPERTIROIDISMO</label>
						</div>
						<input type="hidden" name="actualHipertiroidismo[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkHipertiroidismoParentesco" name="actualHipertiroidismo[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input actual" type="checkbox" value="SINDROME DE OVARIO POLIQUISTICO" id="checkSindromeActual" name="actualSindrome[]">
			                <label class="form-check-label" for="checkSindromeActual">SINDROME DE OVARIO POLIQUISTICO</label>
						</div>
						<input type="hidden" name="actualSindrome[]" value="0">
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control" id="checkSindromeParentesco" name="actualSindrome[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-2">
							<input class="form-check-input actual" type="checkbox" value="OTROS" id="otroActual" name="actualOtro[]">
			                <label class="form-check-label" for="otroActual">OTROS</label>
						</div>
						<div class="form-group input-group input-group-sm col-md-4 indique" id="otroIndiqueActual">							
								<div class="input-group-prepend hide">
				                    <span class="input-group-text" id="inputGroup-sizing-sm">INDIQUE</span>
				                </div>
				                <input type="text" class="form-control hide" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="actualOtro[]">       
			             </div>
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
			                      <span class="input-group-text" id="inputGroup-sizing-sm">TRATAMIENTO</span>
			                  </div>
			                  <input type="text" class="form-control otroIndiqueActual" name="actualOtro[]" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div> 
					<div class="form-row col-md-12">
						<div class="form-group form-check  col-md-6">
							<input class="form-check-input" type="checkbox" value="NINGUNO" id="checkNingunoActual" name="actualNinguno[]">
							<input type="hidden" class="form-control"  name="actualNinguno[]" aria-label="Small"  value = "0">
							<input type="hidden" class="form-control"  name="actualNinguno[]" aria-label="Small"  value = "0">
							<input type="hidden" class="form-control"  name="actualNinguno[]" aria-label="Small"  value = "0">
			                    <label class="form-check-label" for="checkNingunoActual">
			                        NINGUNO
			                    </label>
						</div>
						<div class="form-group input-group input-group-sm   col-md-6">							
						</div>
					</div>
				</div>
<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::cirugias::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
				<div class="page-header titulo_cirugia"><small>¿Le han realizado alguna cirugia actualmente?</small></div>
					<div>
				<hr>
					  <input type="radio" id="siCheck" name="cirugia" value="1">
					  <label for="siCheck">SI</label>
					</div>
					<div>
					  <input type="radio" id="noCheck" name="cirugia" value="2" checked>
					  <label for="noCheck">NO</label>
					</div>
				<div class="form-row col-md-12" id="cirugias">
					<div class="form-row col-md-12">
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">NOMBRE</span>
							</div>
							<input type="text" class="form-control disableoff" aria-label="Small" name="operacionUno[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Fecha</span>
							</div>
								<input type="date" class="form-control disableoff" aria-label="Small" name="operacionUno[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">NOMBRE</span>
							</div>
							<input type="text" class="form-control disableoff" aria-label="Small" name="operacionDos[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text " id="inputGroup-sizing-sm">Fecha</span>
							</div>
							<input type="date" class="form-control disableoff" aria-label="Small" name="operacionDos[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
					<div class="form-row col-md-12">
						<div class="form-group input-group input-group-sm col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text " id="inputGroup-sizing-sm">NOMBRE</span>
							</div>
							<input type="text" class="form-control disableoff" aria-label="Small" name="operacionTres[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
						<div class="form-group input-group input-group-sm   col-md-6">
							<div class="input-group-prepend">
								<span class="input-group-text " id="inputGroup-sizing-sm">Fecha</span>
							</div>
							<input type="date" class="form-control disableoff" aria-label="Small" name="operacionTres[]" aria-describedby="inputGroup-sizing-sm" disabled>
						</div>
					</div>
				</div>
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
<!-- :::::::::::::::::::::::::::::::::tratamiento Anterior:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
				<div class="page-header titulo_anterior"><small>CONTROL DE PESO ANTERIOR</small></div>
				<hr>
				<div class="form-row col-md-12" id="anterior">
					<div class="form-control col-md-5 genero">
					<label for="intputSexo" id="intputSexo">Tratamientos de control de peso anteriormente</label>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioControl" name="radioTratamiento" class="custom-control-input" value="1">
						  <label class="custom-control-label" for="customRadioControl">SI</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline radio-Sexo">
						  <input type="radio" id="customRadioControl2" name="radioTratamiento" class="custom-control-input" value="2" checked>
						  <label class="custom-control-label" for="customRadioControl2">NO</label>
						</div>
					</div>
					<div class="form-group col-md-7">
						
					</div>
				</div>
				<div class="form-row col-md-12" id="anteriorMedicamento">
					<label for="medicamentoAnterior">¿Que medicamentos consumio durante el tratamiento de control de peso anterior?</label>
					<input type="text" class="form-control anteriorMedicamento" name="medicamentoAnterior" id="medicamentoAnterior" placeholder="si es mas de un medicamento separalo por una coma (,)" disabled>
				</div>
				<!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
				<input type="submit" id="btn-env" values="enviar" name="enviar">
			</form>
		</div>
	</div>
</div>

