<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CHIMBILA - Anotador de sonidos de murciélagos</title>

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
    <script>
        var dataUrl = 'sample_data.json';
        var postUrl = '/<post_url>'; // This is where data posts to
    </script>
</body>
</html>
