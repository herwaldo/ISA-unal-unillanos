<?php
include('session.php');
//$mysqli = new mysqli("host", "usuario", "contraseña", "base de datos");
// verificar la conexión

if ($db->connect_errno) {
    $arrRespuesta=array("error"=>"Conexión fallida: ".$db->connect_error);

}else{
    /*Establecemos el charset a la conexión para evitar datos erróneos*/
    $db->set_charset("utf8");
    $consulta = "SELECT * FROM anotacion WHERE usuario_id=$identificacion AND audio_id=1";

    if ($resultado = $db->query($consulta)) {
        // obtener un array asociativo
        $arrRespuesta=array();
        while ($fila = $resultado->fetch_assoc()) {
            $arrRespuesta[]=$fila;
        }

        // liberar el conjunto de resultados
        $resultado->free();

    }else{

        $arrRespuesta=array("error"=>"Hubo un problema con la consulta");

    }

    // cerrar la conexión
    //$mysqli->close();
}

//Al final de todo imprimimos el JSON que será recogido en la petición Ajax/jQuery
$json = json_encode($arrRespuesta);
header('Content-Type: application/json');
echo $json;

?>
