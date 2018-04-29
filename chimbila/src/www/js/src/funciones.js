function anotarAudios(cod){
	var parametros = {
		"codigo": cod,
	};
    window.location="annotator.php?codigo="+cod;
    /*$.ajax({
        type: "POST",
        url: "annotator.php",
        data: parametros,
        success: function (data) {
            //data es la respuesta del php
            if(data){
                window.location.replace("http://sitioweb.com");
            }

        }
    });*/
	//var url="../../src/www/annotator.php";
	//$.post("annotator.php",{codigo:cod} ,function (resultados) {
     //   window.location="annotator.php";
    //var w = window.open('');
    //w.document.open();
   //w.document.write(resultados);
    //w.document.close();
	//});

}

function editarColeccion(cod){
    var parametros = {
        "codigo": cod,
    };

    alert(cod);
}

function crearColeccion() {
    $.ajax({ 
           type: "POST", 
           url: 'crearColeccion.php', 
           data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado. 
           success: function(data) { 
           $("#respuesta").html(data); // Mostrar la respuestas del script PHP. 
        } 
    });
}

function crearSubColeccion() {
    $.ajax({ 
           type: "POST", 
           url: 'crearSubColeccion.php', 
           data: $("#formulario2").serialize(), // Adjuntar los campos del formulario enviado. 
           success: function(data) { 
           $("#respuesta").html(data); // Mostrar la respuestas del script PHP. 
        } 
    }); 
}

function eliminarColeccion(cod){
    var parametros = {
        "codigo": cod,
    };
    alert(cod);
}

function envia(cod){ //lo activas con un OnClick
	var codigo = cod; //el input que contiene el dato se llama idarti
	alert("entro para envio");
$.post('../../src/www/annotator.php', { codigo: codigo }, function (result) {
            WinId = window.open('', 'newwin', 'width=400,height=500');//resolucion de la ventana
            WinId.document.open();
            WinId.document.write(result);
            WinId.document.close();
        });
}

function abrirColeccion(cod) {
    
}
/*
$.ajax({
        dataType: 'json', // The type of data that you're expecting back from the server.
        type: 'POST', // he HTTP method to use for the request
        url: goForm.attr('action'),
        data: goForm.serialize(), // Data to be sent to the server.
        beforeSend: function (xhr) {
            submitButton.attr("disabled", "disabled");
            $('a.get-link').text('<?= __('Getting link...') ?>');
        },
        success: function (result, status, xhr) {
            //console.log( result );
            if (result.url) {
                //console.log( result.message + ' - ' + result.url );
                window.open(result.url, "_blank");
                //submitButton.text( 'Redirecting...' );
                //goForm.replaceWith( '<button class="btn btn-default" onclick="javascript: return false;">Redirecting...</button>' );
            } else {
                alert(result.message);
            }
        },
        error: function (xhr, status, error) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        },
        complete: function (xhr, status) {

        }
    });
});*/