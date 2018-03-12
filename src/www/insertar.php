<?php

include('session.php');
header("Content-Type: text/html;charset=utf-8");
//echo 'Hola';
//echo '<br/>';
//echo $row['email'];
//$num = $_POST["annotations"][0]['start'];

//$etiquetas=mysqli_query($db,"select id,nombre from etiqueta");
//$row_etiquetas = mysqli_fetch_assoc($etiquetas);

//foreach ($_POST["annotations"] as $id_etiqueta=>$valores) {
        //echo "El valor de $id_etiqueta <br/><br/>";
        //foreach ($valores as $campo=>$valor){
        //    echo "$campo : $valor <br/>";
        //}
//}

//echo "HOLA ".$_POST["annotations"][0]["annotation"];
//echo "PRoxi  ".$_POST["annotations"][0]["proximity"];
//echo "ADUIO ".$_POST["audio_id"];

if ($_POST["audio_id"]=='4.5.wav'){ //COMPROBAMOS LA RECEPCIÓN DEL AUDIO POR POST.
    $audio_nombre = $row["nickname"]."_audio_1";//.$_POST["audio_id"]; //USAR MÁS ADELANTE BN.
    $audio_id = mysqli_query($db,"select id from audio where nombre='$audio_nombre'");
    $row_audio_id = mysqli_fetch_assoc($audio_id)["id"];
    $usuario_nick = $row["nickname"];
    $usuario_id = mysqli_query($db,"select id from usuario where nickname='$usuario_nick'");
    $row_usuario_id = mysqli_fetch_assoc($usuario_id)["id"];
    $puta = mysqli_query($db,"select nombre from etiqueta where id=4");
    $otraputa = mysqli_fetch_assoc($puta)["nombre"];
    //utf8_encode($otraputa);    //SE TIENE QUE HACER ESTO PARA HALAR LAS TILDES DESDE MYSQL.
    $bool=true;
    foreach ($_POST["annotations"] as $datos){
        $tiempo_ini = $datos["start"];
        $tiempo_fin = $datos["end"];
        $etiqueta_anotacion = $datos["annotation"];
        $etiqueta_proximidad = $datos["proximity"];
        //$etiqueta_comportamiento = $datos["comportamiento"];
        $etiquetas = array($datos["annotation"], $datos["proximity"]);
        foreach ($etiquetas as $etiqueta){
            $etiqueta2 = utf8_decode($etiqueta);
            $id_2 = mysqli_query($db,"select id from etiqueta where nombre='$etiqueta2'");
            $id = mysqli_fetch_assoc($id_2)["id"];
            $sql = "INSERT INTO ANOTACION (`usuario_id`, `audio_id`, `etiqueta_id`, `tiempo_ini`, `tiempo_fin`) 
                    VALUES ($row_usuario_id, $row_audio_id, $id, $tiempo_ini, $tiempo_fin)";
            if (mysqli_query($db, $sql)) {
                //echo ("Agregado exitosamente!");
            } else {
                echo ("Error: " . $sql . "<br>" . mysqli_error($db)   );
                $bool = false;
            }
        }
    }
    if ($bool){
        echo '<script language="javascript">alert("Agregado exitosamente!");</script>';
    }

}



?>
