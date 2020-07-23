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
				url: "views/layout/ajax.php",
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
});