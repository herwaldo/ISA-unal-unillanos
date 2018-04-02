<?php
include('session.php');

$codigo=$_POST["codigo"];
$usuario=$identificacion;

echo "codigo $codigo y usuario $usuario";

?>
<!DOCTYPE html>
<html>
<head>
    <title>CHIMBILA - Anotador de sonidos de murciélagos</title>
    <!-- Para usar las tildes bién desde MySQL -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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

    </div>
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
    <div class="annotation">
        <div class="labels"></div>
        <div class="audio_visual"></div>
        <div class="play_bar"></div>
        <div class="hidden_img"></div>
        <div class="creation_stage_container"></div>
        <div class="submit_container"></div>
    </div>

    <div style="background-color:#8FBC8F;" id="myDiv"></div>
    <script>
        var dataUrl = 'sample_data.json';
        var postUrl = '/insertar.php' //'/<post_url>'; // This is where data posts to
    </script>

    <!-- Solo permite crear un espacio debajo del botón para que se vea mejor. -->
    <div style="margin: 4%">
    </div>
</body>
</html>
