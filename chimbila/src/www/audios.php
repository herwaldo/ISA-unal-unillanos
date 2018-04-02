<?php
include('session.php');
$resultado = mysqli_query($db,"SELECT a.nombre_audio, a.id,j.nombre_coleccion FROM audio a, coleccion c, jerarquia j WHERE a.id=c.audio_id AND c.jerarquia_id=j.id AND j.usuario_id=".$identificacion."");
$coleccion = mysqli_query($db,"SELECT nombre_coleccion FROM jerarquia WHERE jerarquia.usuario_id=".$identificacion."");
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
<<<<<<< HEAD
<<<<<<< HEAD
    <script type="text/javascript" src="js/src/funciones.js" defer></script>
    
=======
    <script type="text/javascript" src="js/src/funciones.js"></script>
>>>>>>> 9ecc03e7008154897f5351125763a3011e5d206a
=======
    <script type="text/javascript" src="js/src/funciones.js"></script>
>>>>>>> 9ecc03e7008154897f5351125763a3011e5d206a
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
                    echo "<li>".utf8_encode($col['nombre_coleccion'])."</li>";
                }
                ?>
            </ul>
        </div>
        <br>
        <br><br>
        <div class="col s9">
            <div>
                <a class="modal-trigger waves-effect waves-light btn" id="trigger" href="#CrearColeccion-modal"><i class="material-icons left">add_circle</i>Agregar Colección</a>

                <a class="waves-effect waves-light btn"><i class="material-icons left">add_circle</i>Agregar Subcolección</a>
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
                            echo "  <td>".utf8_encode($value['nombre_coleccion'])."</td>";
                            echo "  <td>".utf8_encode($value['nombre_coleccion'])."</td>";
                            echo "  <td><a class='waves-effect waves-light blue btn-small white-text' onclick =' anotarAudios(" .$value['id'] ."); '><i class='material-icons left'>play_circle_outline</i></a>  <a class='waves-effect waves-light yellow btn-small white-text' onclick =' editarColeccion(" .$value['id'] ."); '><i class='material-icons left'>edit</i></a>  <a class='waves-effect waves-light red btn-small white-text' onclick =' eliminarColeccion(" .$value['id'] ."); '><i class='material-icons left'>delete</i></a></td>";
                            echo "</tr>";
                            $contador++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Colección -->
    <div id="CrearColeccion-modal" class="modal" style="max-height: 50% !important;">
        <div class="modal-content" id="modal">
            <form method = "post" id="formulario">
              <label for="NameColecion" >Nombre Colección:</label>
              <input id="NameColeccion" type = "text" name = "NameColeccion"  placeholder="Capturas viernes 10 febrero" class = "box" required/><br /><br />
              <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
              <input type="submit" onclick="crearColeccion();" class="btn btn-primary" value="Agregar">
              <!--input type = "submit" name="submit" value = " Login "/--><br/>
           </form> 
        </div>
    </div>

    <!-- Modal Form SubColección -->
    <div id="CrearSubColeccion-modal" class="modal" style="max-height: 50% !important;">
        <div class="modal-content" id="modal">
            <form method = "post" id="formulario2">
              <label for="NameSubColecion" >Nombre SubColección:</label>
              <input id="NamSubColeccion" type = "text" name = "NameSubColeccion"  placeholder="Capturas viernes 10 febrero" class = "box" required/><br /><br />
              <label for="SubColeccion_select"> Colección Principal:</label>
              <select name="SubColeccion_select" class = "browser-default">
                <?php
                    foreach ($coleccion as $key => $col) {
                        echo "<option value=".$col['id'].">".utf8_encode($col['nombre_coleccion'])."</option>";
                    }
                ?>
              </select>
              <br><br><br>
              <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
              <input type="submit" onclick="crearSubColeccion();" class="btn btn-primary" value="Agregar">
              <!--input type = "submit" name="submit" value = " Login "/--><br/>
           </form> 
        </div>
    </div>

    <script>
        var dataUrl = 'sample_data.json';
        var postUrl = '/<post_url>'; // This is where data posts to
    </script>
    <script type="text/javascript" src="js/src/funciones.js"></script>
</body>
</html>
