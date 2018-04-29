function anotarAudios(cod){

    var url="../../src/www/annotator.php";
    $.post(url,{codigo:cod} ,function (resultados) {
    var w = window.open('');
    w.document.open();
    w.document.write(resultados);
    w.document.close();
    });

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