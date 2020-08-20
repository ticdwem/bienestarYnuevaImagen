$(document).ready(function(){
/* dat picker al campo fecha*/
	$('#dateInicio').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'dd-mm-yyyy'
	})
/* data table paciente nuevo */
	$("#newPaciente").DataTable({
		"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
	});
/*detectamos el select seleccionado*/
	$(".inpuEstado").on('change',function(){
		var dato = $(this).val();
		var id = new FormData();
		var selectMun = '';
			id.append("idEstado",dato);
	 	$.ajax({
				url: getAbsolutePath()+"views/layout/ajax.php",
				method:"POST",
				data:id,
				cache:false,
				contentType:false,
				processData:false,
				beforeSend:function(){
				$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
						},
				success:function(exist){
					$.each(exist, function(i,item){				
						 selectMun += '<option value="'+item.id+'">'+item.name+'</option>';
					});
					$("#inpuMunicipio").html(selectMun);
				 }
			})
	})

/*:::::::::::::::::::::::::::::::::::::::::::::::validar toma de algun medicamento::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#selectMedicamento").on('change', function(){
		var desicion = $(this).val();

		if(desicion == 1){
			$("#medicamento").css('display','block');
			$("#inputNombreMedicamento").css('border','1px solid red');
		}else if(desicion == 2){
			$("#medicamento").css('display','none');
		}
	})
/*:::::::::::::::::::::::::::::::::::::::::::::::validar el correo que sea unico::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#inpuCorreo").on("change", function(){
		var emailer = $(this).val();
		var validar = expRegular("email",emailer);

		if(validar != 0){
			var mail = new FormData();
			mail.append("correo",emailer);
	 	$.ajax({
				url: getAbsolutePath()+"views/layout/ajax.php",
				method:"POST",
				data:mail,
				cache:false,
				contentType:false,
				processData:false,
				beforeSend:function(){
				$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
						},
				success:function(exsisteEmail){
					if(exsisteEmail == 1){
						$("#inpuCorreo").removeClass("is-valid");
						$("#error").removeClass("valid-feedback");

						$("#inpuCorreo").addClass("is-invalid");
						$("#error").addClass("invalid-feedback");
						$("#error").html("ESTE CORREO ESTA EN USO");
					}else if(exsisteEmail == 0){
						$("#inpuCorreo").removeClass("is-invalid");
						$("#error").removeClass("invalid-feedback");

						$("#inpuCorreo").addClass("is-valid");
						$("#error").addClass("valid-feedback");
						$("#error").html("CORRECTO!!");
					}			
				 }
			})
		}

	});
/*:::::::::::::::::::::::::::::::::::::::::::::::validar hombre o mujer para mostrar formulario::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("input:radio[name=customRadioSexo]").on('change',function(){
		if($(this).is(':checked')){
			var genero = $(this).val();
			if(genero == 'hombre'){
				$(".hideOn").attr('disabled','disabled');
			}else if(genero == 'mujer'){
				$(".hideOn").removeAttr('disabled');

			}
		}
	})
/*:::::::::::::::::::::::::::::::::::::::::::::::validar si ah tenido cirugia::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("input:radio[name=cirugia]").on('change',function(){
		if($(this).is(':checked')){
			var surgery = $(this).val();
			if(surgery == 1){
				$(".disableoff").removeAttr('disabled');
			}else if(surgery == 2){
				$(".disableoff").attr('disabled','disabled');

			}
		}
	})
/*:::::::::::::::::::::::::::::::::::::::::::::::validar si ah tenido cirugia::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("input:radio[name=radioTratamiento]").on('change',function(){
		if($(this).is(':checked')){
			var tratamiento = $(this).val();
			if(tratamiento == 1){
				$(".anteriorMedicamento").removeAttr('disabled');
			}else if(tratamiento == 2){
				$(".anteriorMedicamento").attr('disabled','disabled');

			}
		}
	})
/*:::::::::::::::::::::::::::::::::::::::::::::::validar el enfermedades::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#checkDeabetes").on('change',function(){
		if($(this).is(':checked')){
			$("#checkDeabetesParentesco").removeAttr('disabled');
		}else{
			$("#checkDeabetesParentesco").attr('disabled','disabled');			
		}
	})
	$("#checkHipertension").on('change',function(){
		if($(this).is(':checked')){
			$("#checkHipertensionParentesco").removeAttr('disabled');
		}else{
			$("#checkHipertensionParentesco").attr('disabled','disabled');			
		}
	})
	$("#checkAsma").on('change',function(){
		if($(this).is(':checked')){
			$("#checkAsmaParntesco").removeAttr('disabled');
		}else{
			$("#checkAsmaParntesco").attr('disabled','disabled');			
		}
	})
	$("#checkCancer").on('change',function(){
		if($(this).is(':checked')){
			$("#checkCancerParntesco").removeAttr('disabled');
		}else{
			$("#checkCancerParntesco").attr('disabled','disabled');			
		}
	})
	$("#checkAlergias").on('change',function(){
		if($(this).is(':checked')){
			$("#checkAlergiasParntesco").removeAttr('disabled');
		}else{
			$("#checkAlergiasParntesco").attr('disabled','disabled');			
		}
	})
	 // Comprobar cuando cambia Ninguno Checkbox
	    $('#checkNinguno').on('change', function() {
	        if ($(this).is(':checked') ) {
	            $(".parentesco").prop("checked",false);
	            $(".parentesco").attr('disabled','disabled');

	            $("#otroIndique").css('visibility','hidden');
            	$(".otroIndique").attr('disabled','disabled');
            	$("#checkDeabetesParentesco").attr('disabled','disabled');
            	$("#checkHipertensionParentesco").attr('disabled','disabled');	
				$("#checkCancerParntesco").attr('disabled','disabled');		
	        } else{
	            $(".parentesco").removeAttr('disabled','disabled');
	        }
	    });
	    // Comprobar cuando cambia otros Checkbox
    $('#checkOtrosFamilia').on('change', function() {
        if ($(this).is(':checked') ) {
            $("#otroIndique").css('visibility','visible');
            $('.otroIndique').removeAttr('disabled');
        } else {
            $("#otroIndique").css('visibility','hidden');
            $(".otroIndique").attr('disabled','disabled');
        }
    });
/*:::::::::::::::::::::::::::::::::::::::::::::::validar checkbox actual::::::::::::::::::::::::::::::::::::::::::::::::::::*/

$("#checkDeabetesActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkDeabetesActualParentesco").removeAttr('disabled');
	}else{
		$("#checkDeabetesActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkHipertensionActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkHipertensionActualParentesco").removeAttr('disabled');
	}else{
		$("#checkHipertensionActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkAsmaActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkAsmaActualParentesco").removeAttr('disabled');
	}else{
		$("#checkAsmaActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkCancerActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkCancerActualParentesco").removeAttr('disabled');
	}else{
		$("#checkCancerActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkAlergiasActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkAlergiasActualParentesco").removeAttr('disabled');
	}else{
		$("#checkAlergiasActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkDislipidemiasActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkDislipidemiasActualParentesco").removeAttr('disabled');
	}else{
		$("#checkDislipidemiasActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkHepaticosActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkHepaticosActualParentesco").removeAttr('disabled');
	}else{
		$("#checkHepaticosActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkRenalesActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkRenalesActualParentesco").removeAttr('disabled');
	}else{
		$("#checkRenalesActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkUrinariosActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkUrinariosActualParentesco").removeAttr('disabled');
	}else{
		$("#checkUrinariosActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkProstataActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkProstataActualParentesco").removeAttr('disabled');
	}else{
		$("#checkProstataActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkDisfusionActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkDisfusionActualParentesco").removeAttr('disabled');
	}else{
		$("#checkDisfusionActualParentesco").attr('disabled','disabled');			
	}
})
$("#checkHipotiroidismoActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkHipotiroidismoParentesco").removeAttr('disabled');
	}else{
		$("#checkHipotiroidismoParentesco").attr('disabled','disabled');			
	}
})
$("#checkHipertiroidismoActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkHipertiroidismoParentesco").removeAttr('disabled');
	}else{
		$("#checkHipertiroidismoParentesco").attr('disabled','disabled');			
	}
})
$("#checkSindromeActual").on('change',function(){
	if($(this).is(':checked')){
		$("#checkSindromeParentesco").removeAttr('disabled');
	}else{
		$("#checkSindromeParentesco").attr('disabled','disabled');			
	}
})
// Comprobar cuando cambia Ninguno Checkbox
$('#checkNingunoActual').on('change', function() {
	if ($(this).is(':checked') ) {
		$(".actual").prop("checked",false);
		$(".actual").attr('disabled','disabled');
		
		$("#otroIndiqueActual").css('visibility','hidden');
		$(".otroIndiqueActual").attr('disabled','disabled');
		$("#checkDeabetesActualParentesco").attr('disabled','disabled');
		$("#checkHipertensionActualParentesco").attr('disabled','disabled');	
		$("#checkCancerActualParentesco").attr('disabled','disabled');			
		$("#checkAsmaActualParentesco").attr('disabled','disabled');	
		$("#checkAlergiasActualParentesco").attr('disabled','disabled');	
		$("#checkDislipidemiasActualParentesco").attr('disabled','disabled');
		$("#checkHepaticosActualParentesco").attr('disabled','disabled');		
		$("#checkRenalesActualParentesco").attr('disabled','disabled');		
		$("#checkUrinariosActualParentesco").attr('disabled','disabled');
		$("#checkProstataActualParentesco").attr('disabled','disabled');	
		$("#checkDisfusionActualParentesco").attr('disabled','disabled');	
		$("#checkHipotiroidismoParentesco").attr('disabled','disabled');		
		$("#checkHipertiroidismoParentesco").attr('disabled','disabled');		
		$("#checkSindromeParentesco").attr('disabled','disabled');		
	} else{
		$(".actual").removeAttr('disabled','disabled');
	}
});
// Comprobar cuando cambia otros Checkbox
$('#otroActual').on('change', function() {
	if ($(this).is(':checked') ) {
		$("#otroIndiqueActual").css('visibility','visible');
		$('.otroIndiqueActual').removeAttr('disabled');
	} else {
		$("#otroIndiqueActual").css('visibility','hidden');
		$(".otroIndiqueActual").attr('disabled','disabled');
	}
	});
	/*:::::::::::::::::::::::::::::::::::::::::::::::colocar nombre en nombre de consutorio::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#inpuColoniaConsultorio").on('change', function() {
		var valorCalle,valorSelect,nuevoNombre;
		valorCalle = $(this).val();
		valorSelect = $(".altaConsultorio option:selected").text();
		nuevoNombre = $("#intputnameConsultorio").val(valorSelect+' '+valorCalle);
		
		
		
	});
	
	/*:::::::::::::::::::::::::::::::::::::::::::::::sumar y resatar control::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#inputMesotrolSumaResta").on('keyup',function(){
		var totalNow = parseInt($("#mesoTotal").html(),10);
		var updateNow = parseInt($(this).val(),10);
		var control = $("#meso").attr('id');
		var jsonBack;
		jsonBack = enviarAjax(control,totalNow,updateNow);	
	});
	$("#inputControlSumaResta").on('keyup',function(){
		var totalNow = parseInt($("#conTotal").html(),10);
		var updateNow = parseInt($(this).val(),10);
		var control = $("#con").attr('id');
		var jsonBack;
		jsonBack = enviarAjax(control,totalNow,updateNow);		
	});
	/*:::::::::::::::::::::::::::::::::::::::::::::::VALIDAR BOTONES DE ACTUALIZAR MESO::::::::::::::::::::::::::::::::::::::::::::::::::::*/
	$("#btnSumaCon,#btnRestarCon").on("click",function(){
		var validarInput = emptyInput($("#inputControlSumaResta").val());

		if(validarInput == "empty"){
			$("#inputControlSumaResta").css("border","1px solid red");
			$(".errorSumResta").css("color","red");
			$(".errorSumResta").html("DEBES INGRESAR NUMERO A SUMAR O A RESTAR");
			return false;
		}

	});
	$("#btnSumaMeso,#btnRestarMeso").on("click",function(){
		var validarInputMeso = emptyInput($("#inputMesotrolSumaResta").val());
		
		if(validarInputMeso == "empty"){
			console.log(validarInputMeso);
			$("#inputMesotrolSumaResta").css("border","1px solid red");
			$(".errorSumResta").css("color","red");
			$(".errorSumResta").html("DEBES INGRESAR NUMERO A SUMAR O A RESTAR");
			return false;
		}

	});
/* :::::::::::::::::::::::::::::::::::::::::::::::loguin:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	$("#emailLoggin").on('change',function(){
		var email = $(this).val();
		var validarEmail =  expRegular("email",email);

		if(validarEmail != 0){
			var mail = new FormData();
			mail.append("correoLoggin",email);
	 	$.ajax({
				url: getAbsolutePath()+"views/layout/ajax.php",
				method:"POST",
				data:mail,
				cache:false,
				contentType:false,
				processData:false,
				beforeSend:function(){
				$('.spinnerWhite').html('<i class="fas fa-sync fa-spin"></i>');
						},
				success:function(emaillog){					
					if(emaillog){
						$("#tipoUser").val(emaillog.tipo);
						if(emaillog.tipo == 2 || emaillog.tipo == 3){
							$(".selectH").css('display','block');
						}else{
							$(".selectH").css('display','none');
						}
					}else{
						$("#tipoUser").val(0);
					}
				 }
			})
		}
	});

	$(".btnstart").on("click", function(){		
		$("#frmLogginVerif").submit(function(e){
			var correo = emptyInput($("#emailLoggin").val());
			var pass = emptyInput($("#inputPassLoggin").val());
			var tipo = $("#tipoUser").val();
			if(correo == "empty"){
				$("#emailLoggin").attr('placeholder','RECUERDA ESTE CAMPO ES OBLIGATORIO');
				e.preventDefault();
			}

			if(pass == "empty"){
				$("#inputPassLoggin").attr('placeholder','RECUERDA ESTE CAMPO ES OBLIGATORIO');
				e.preventDefault();
			}

			if(tipo == 2 || tipo == 3){
				var select = emptyInput($("#consul option:selected").val());

				if(select == "empty"){
					$(".errorSelect").css({'color':'red','opacity':'0.5','font-family': "'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif"});
					$(".errorSelect").html('RECUERDA ESTE CAMPO ES OBLIGATORIO');
					e.preventDefault();
				}
			}

		})
	})
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::CobroEstaturaObservacion::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	$("#btnUpdateRegistro").on('click',function(){
		$("#frmCobroEstatura").submit(function(e){
			var cobro = emptyInput($("#cobro").val());
			var estatura = emptyInput($("#txtEstatura").val());
			var observacion = emptyInput($("#observacion").val());
			var contenido;

			if(cobro == "empty"){
				$("#cobro").addClass('is-invalid');
				$("#alertaCobro").addClass('invalid-feedback');
				$("#alertaCobro").html('CAMPO OBLIGATORIO');
				e.preventDefault();
			}else{
				cobro = expRegular('decimales',$("#cobro").val());
				if(cobro != 0){
					$("#cobro").addClass('is-valid');
					$("#alertaCobro").addClass('valid-feedback');
					$("#alertaCobro").html('CORRECTO!!');
				}else{
					$("#cobro").addClass('is-invalid');
					$("#alertaCobro").addClass('invalid-feedback');
					$("#alertaCobro").html('FORMATO INVALIDO');
					e.preventDefault();
				}
			}

			if(estatura == "empty"){
				$("#txtEstatura").addClass('is-invalid');
				$("#alertaEstatura").addClass('invalid-feedback');
				$("#alertaEstatura").html('CAMPO OBLIGATORIO');
				e.preventDefault();
			}else{
				estatura = expRegular('decimales',$("#txtEstatura").val());
				if(estatura != 0){
					$("#txtEstatura").addClass('is-valid');
					$("#alertaEstatura").addClass('valid-feedback');
					$("#alertaEstatura").html('CORRECTO!!');
				}else{
					$("#txtEstatura").addClass('is-invalid');
					$("#alertaEstatura").addClass('invalid-feedback');
					$("#alertaEstatura").html('FORMATO INVALIDO');
					e.preventDefault();	
				}
			}

			if(observacion == "empty"){
				$("#observacion").addClass('is-invalid');
				$("#alertaObs").addClass('invalid-feedback');
				$("#alertaObs").html('CAMPO OBLIGATORIO');
				e.preventDefault();
			}else{
				observacion = expRegular('messagge',$("#observacion").val());
				contenido = $("#observacion").val().length;

				if(observacion =! 0 && contenido <= 500){
					$("#observacion").addClass('is-valid');
					$("#alertaObs").addClass('valid-feedback');
					$("#alertaObs").html('CORRECTO!!');
				}else{
					$("#observacion").addClass('is-invalid');
					$("#alertaObs").addClass('invalid-feedback');
					$("#alertaObs").html('MENOR A 500 CARACTERES O NO INGRESES VALORES INCORRECTOS');
					e.preventDefault();
				}
			}

		})
	});
});