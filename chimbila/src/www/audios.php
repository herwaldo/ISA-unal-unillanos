<?php
include('session.php');
$resultado = mysqli_query($db,"SELECT c.nombre, a.nombre_audio, a.id FROM audio a, coleccion c, usuario u WHERE a.id=c.audio_id AND c.users_user_id=u.id AND u.id=".$identificacion."");
$coleccion = mysqli_query($db,"SELECT DISTINCT nombre FROM coleccion WHERE users_user_id=".$identificacion."");
$contador=1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>CHIMBILA - Anotador de sonidos de murciélagos</title>
    <!-- Para usar las tildes bién desde MySQL -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/audio-annotator.css">

    <script type="text/javascript" src="js/lib/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/lib/materialize.min.js"></script>
    <script type="text/javascript" src="js/lib/wavesurfer.min.js"></script>
    <script type="text/javascript" src="js/lib/wavesurfer.spectrogram.min.js"></script>
    <script type="text/javascript" src="js/colormap/colormap.min.js"></script>

    <script type="text/javascript" src="js/src/message.js"></script>
    <script type="text/javascript" src="js/src/wavesurfer.regions.js"></script>
    <script type="text/javascript" src="js/src/wavesurfer.drawer.extended.js"></script>
    <script type="text/javascript" src="js/src/wavesurfer.labels.js"></script>
    <script type="text/javascript" src="js/src/hidden_image.js"></script>
    <script type="text/javascript" src="js/src/components.js"></script>
    <script type="text/javascript" src="js/src/annotation_stages.js"></script>
    <script type="text/javascript" src="js/src/main.js" defer></script>
    <script type="text/javascript" src="js/src/funciones.js"></script>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
          <a href="#" class="brand-logo">CHIMBILA</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>Usuario : <?php echo $login_session; ?></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
            <li><a class ="modal-trigger btn" id="trigger" href="#instructions-modal">Instrucciones</a></li>
          </ul>
        </div>
    </nav>    

    <!-- Modal Structure -->
    <div id="instructions-modal" class="modal" style="max-height: 50% !important;">
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
        <div class="modal-content">
            <div id="instructions-container"></div>
            <div class="videowrapper">
                <iframe id="tutorial-video" width="50%" height="50%" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s3">
            <h4>Colecciones</h4>
            <ul>
                <?php
                foreach ($coleccion as $key => $col) {
                    echo "<li>".utf8_encode($col['nombre'])."</li>";
                }
                ?>
            </ul>
        </div>
        <br>
        <br><br>
        <div class="col s9">
            <div>
                <a class="waves-effect waves-light btn"><i class="material-icons left">add_circle</i>Agregar Colección</a>
            </div>
            <div>
                <h3>Prueba de título</h3>
                <table>
                    <thead>
                        <th>No°</th>
                        <th>Nombre Audio</th>
                        <th>Colección</th>
                        <th>Estado</th>
                        <th><center>Acción</center></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado as $key => $value) {
                            echo "<tr>";
                            echo "  <td>".$contador."</td>";
                            echo "  <td>".$value['nombre_audio']."</td>";
                            echo "  <td>".utf8_encode($value['nombre'])."</td>";
                            echo "  <td>".utf8_encode($value['nombre'])."</td>";
                            echo "  <td><a class='waves-effect waves-light blue btn-small white-text' onclick =' anotarAudios(" .$value['id'] ."); '><i class='material-icons left'>play_circle_outline</i>Abrir</a>  <a class='waves-effect waves-light yellow btn-small white-text' onclick =' anotarAudios(" .$value['id'] ."); '><i class='material-icons left'>edit</i>Modificar</a>  <a class='waves-effect waves-light red btn-small white-text' onclick =' anotarAudios(" .$value['id'] ."); '><i class='material-icons left'>delete</i>Eliminar</a></td>";
                            echo "</tr>";
                            $contador++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

</body>
</html>
