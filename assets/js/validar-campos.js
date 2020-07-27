$(document).ready(function() {
    $("#basic-form").validate({
      rules: {
        intputname : {
          required: true,
          minlength: 3
        },
        inputAppat: {
            required: true,
            minlength: 3
        },
        inputApmat: {
            required: true,
            minlength: 3
        },
     
      },
      messages : {
        intputname: {
            required: "Escribe nombre con mas de 3 caracteres"
        },
        inputAppat: {
          required: "Escribe tu apellido paterno con mas de 3 caracteres"
         
        },
        inputApmat: {
            required: "Escribe tu apellido materno con mas de 3 caracteeres"
        },
      }
    });
  });