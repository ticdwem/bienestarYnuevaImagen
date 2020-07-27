$(document).ready(function(){
/* dat picker al campo fecha*/
	$('#dateInicio').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'dd-mm-yyyy'
	})

/*detectamos el select seleccionado*/
	$("#inpuEstado").on('change',function(){
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
/*:::::::::::::::::::::::::::::::::::::::::::::::validar el correo que sea unico::::::::::::::::::::::::::::::::::::::::::::::::::::*/
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
	$("#checkCancer").on('change',function(){
		if($(this).is(':checked')){
			$("#checkCancerParntesco").removeAttr('disabled');
		}else{
			$("#checkCancerParntesco").attr('disabled','disabled');			
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
	$("#checkCancerActual").on('change',function(){
		if($(this).is(':checked')){
			$("#checkCancerActualParentesco").removeAttr('disabled');
		}else{
			$("#checkCancerActualParentesco").attr('disabled','disabled');			
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
});