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
//echo '<script language="javascript">alert("Insertando...  !");</script>';
//if ($_POST["audio_id"]=='4.5.wav'){ //COMPROBAMOS LA RECEPCIÓN DEL AUDIO POR POST.
    $audio_id = $_POST["audio_id"];//.$_POST["audio_id"]; //USAR MÁS ADELANTE BN.
    //$audio_id = mysqli_query($db,"select id from audio where id='$audio_nombre'");
    //$row_audio_id = mysqli_fetch_assoc($audio_id)["id"];
    $usuario_nick = $row["nickname"];
    $usuario_id = mysqli_query($db,"select id from usuario where nickname='$usuario_nick'");
    $row_usuario_id = mysqli_fetch_assoc($usuario_id)["id"];
    //$cusa = mysqli_query($db,"select nombre from etiqueta where id=4");
    //$otracusa = mysqli_fetch_assoc($puta)["nombre"];
    //utf8_encode($otracusa);    //SE TIENE QUE HACER ESTO PARA HALAR LAS TILDES DESDE MYSQL.
    $bool=false;
    if(isset($_POST["annotations"])){
        foreach ($_POST["annotations"] as $datos){
            $tiempo_ini = $datos["start"];
            $tiempo_fin = $datos["end"];
            //Cargamos los datos de las etiquetas.
            $etiqueta_anotacion = $datos["annotation"];
            $etiqueta_proximidad = $datos["proximity"];
            $etiqueta_comportamiento = $datos["comportamiento"];
            $etiqueta_murcielagos = $datos["murcielagos"];
            //Creamos un array para que en el for inserte cada uno.
            $etiquetas = array($datos["annotation"], $datos["proximity"], $datos["comportamiento"], $datos["murcielagos"]);
            foreach ($etiquetas as $etiqueta){
                $etiqueta2 = utf8_decode($etiqueta);
                if($etiqueta2==''){
                    //break;
                }else{
                    $id_2 = mysqli_query($db,"select id from etiqueta where nombre='$etiqueta2'");
                    $id = mysqli_fetch_assoc($id_2)["id"];
                    $sql = "INSERT INTO ANOTACION (`usuario_id`, `audio_id`, `etiqueta_id`, `tiempo_ini`, `tiempo_fin`) 
                        VALUES ($row_usuario_id, $audio_id, $id, $tiempo_ini, $tiempo_fin)";
                    if (mysqli_query($db, $sql)) {
                        //echo ("Agregado exitosamente!");
                        $bool = true;
                    } else {
                        echo ("Error: " . $sql . "<br>" . mysqli_error($db)   );
                        $bool = false;
                    }
                }

            }
        }
        if ($bool){
            echo '<script language="javascript">alert("Agregado exitosamente!");</script>';
        }
    }
//}

$resultado = mysqli_query($db,"SELECT a.nombre_audio, a.id, j.nombre_coleccion, t.nombre_estado FROM audio a, coleccion c, jerarquia j, tipo_estado t WHERE a.id=c.audio_id AND c.jerarquia_id=j.id AND t.id=c.tipo_estado_id AND j.usuario_id=".$identificacion."");
$coleccion = mysqli_query($db,"SELECT nombre_coleccion,antecesor_id FROM jerarquia WHERE jerarquia.usuario_id=".$identificacion."");
$contador=1;
$consultaSQL = "SELECT a.id, u.nickname, t.nombre as etiqueta, e.nombre as valor, a.tiempo_ini, a.tiempo_fin FROM anotacion a, usuario u, etiqueta e, tipo_etiqueta t WHERE u.id=a.usuario_id AND e.id=a.etiqueta_id AND t.id=e.tipo_etiqueta_id AND a.audio_id=$audio_id AND a.usuario_id=$identificacion ORDER BY a.id";
$resultadoAnotaciones = mysqli_query($db,$consultaSQL."");

?>

<div class="row">
    <div class="col s2">
    </div>
    <div class="col s9" style="align-content: center;">
        <h4>Mis Anotaciones</h4>
        <table cellpadding="1" cellspacing="1" class="table table-hover" id="myTable">
            <thead>
            <th>No°</th>
            <th>Usuario</th>
            <th>Etiqueta</th>
            <th>Valor</th>
            <th><center>Tiempo_Ini</center></th>
            <th>Tiempo_Fin</th>
            <th><center>Eliminar?</center></th>
            </thead>
            <tbody>
            <?php
            foreach ($resultadoAnotaciones as $key => $value) {
                echo "<tr>";
                echo "  <td>".$contador."</td>";
                echo "  <td>".utf8_encode($value['nickname'])."</td>";
                echo "  <td>".utf8_encode($value['etiqueta'])."</td>";
                echo "  <td>".utf8_encode($value['valor'])."</td>";
                echo "  <td>".utf8_encode($value['tiempo_ini'])."</td>";
                echo "  <td>".utf8_encode($value['tiempo_fin'])."</td>";
                echo "  <td><a class='waves-effect waves-light red btn-small white-text' onclick ='eliminarAnotacion(".$value['id'].");'><i class='material-icons left'>delete</i></a></td>";
                echo "</tr>";
                $contador++;
            }
            ?>
            </tbody>
        </table>
        <div class="col-md-12 center text-center">
            <span class="left" id="total_reg"></span>
            <ul class="pagination pager" id="myPager"></ul>
        </div>
    </div>
</div>

<div id="respuesta"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').pageMe({
            pagerSelector:'#myPager',
            activeColor: 'green',
            prevText:'Anterior',
            nextText:'Siguiente',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:15
        });

        // Write on keyup event of keyword input element
        /*$("#search").keyup(function(){

            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#tabla tbody tr"), function() {
                    alert("Encontrado");
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                         $(this).hide();
                    else
                         $(this).show();
            });
        }); */

    });

    function eliminarAnotacion(cod) {

        $.ajax({
            type: "POST",
            url: 'eliminarAnotacion.php',
            data: {codigo: cod},
            success: function(data) {
                //alert("Anotación eliminada Satisfactoriamente!")
                $("#respuesta").html(data);
                $("#myDiv").load(" #myDiv");
            }
        });

    };
</script>