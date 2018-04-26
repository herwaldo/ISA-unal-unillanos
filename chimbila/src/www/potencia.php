<?php
include('session.php');
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
	<script type="text/javascript" src="js/lib/p5.min.js"></script>
	<!--<script type="text/javascript" src="js/lib/p5.dom.min.js"></script>-->
	<script type="text/javascript" src="js/lib/p5.dom.js"></script>
	<script type="text/javascript" src="js/lib/p5.sound.js"></script>
	<script type="text/javascript" src="js/lib/sketch.js"></script>
	<script type="text/javascript" src="js/lib/plotly-latest.min.js"></script>
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
	    <div id="tester" style="width:100%;height:350px;"></div>
        <div class="labels"></div>
        <div class="audio_visual"></div>
        <div class="play_bar"></div>
		 <div class="interval" style="position:relative; width: 450px; margin:auto; font-weight: bold">Segundos atras:<input type="number" id="timeback" value="0.0" style="width: 10%;text-align:center; " /> / Segundos adelante: <input type="number" id="timenext" value="0.0" style="width: 10%;text-align:center;" /></div>
        <div class="hidden_img"></div>
        <div class="creation_stage_container"></div>
        <div class="submit_container"></div>
		
    </div>

    <div style="background-color:#8FBC8F;" id="myDiv"></div>
    <script>
	  var dataUrl = 'sample_data.json';
	  var postUrl = '/insertar.php' //'/<post_url>'; // This is where data posts to
	  var osc;
	  var fft;
	  var spectralCentroid;
	  var centroidplot;
	  var mySound;
	  var coordenadasXY = [];
	  var j=0;
	  var p5Sketch;
	  var x = 5;
	  var pointsX = [];
	  var pointsY = [];
	  var tiemposelect = 0.0;
	  var tiempo_atras;
	  var tiempo_adelante;
	  var finalizo = false;
	  
	function preload() {
	mySound = loadSound('4.5.wav');
	}
	function setup(){
	  var canvas  = createCanvas(2000,400);
	  if(mySound.isLoaded()){
	  mySound.setVolume(0.4);
	  mySound.play();
	  fft = new p5.FFT();
	  fft.setInput(mySound);
	  }
	 
	}

	function draw(){
	 
	  var tiempoactual = mySound.currentTime();
	  var nyquist = 22050;
	  background(0);
	  var freq = map(mouseX, 0, 800, 20, 15000);
	  freq = constrain(freq, 1, 20000);

	  var spectrum = fft.analyze();
	  noStroke();
	  fill(0,255,0); // spectrum is green
	  for (var i = 0; i< spectrum.length; i++){
		var x = map(i, 0, spectrum.length, 0, width);
		var h = -height + map(spectrum[i], 0, 255, height, 0);
		rect(x, height, width / spectrum.length, h );

	  }
	  spectralCentroid = fft.getCentroid();
	  var mean_freq_index = spectralCentroid/(nyquist/spectrum.length);
	  centroidplot = map(log(mean_freq_index), 0, log(spectrum.length), 0, width);
	  
	  stroke(255);
	  rect(centroidplot, 0, width / spectrum.length, height)
	  var potencia = fft.getEnergy(freq);
	  text('Potencia: ' + round(potencia)+'Hz', 10, 10);
	  mySound.onended(function(){
		 
	  var TESTER = document.getElementById('tester');
		Plotly.plot( TESTER, [{
		x: pointsX,
		y: pointsY }], {
		title: 'Potencia de la señal',
		  xaxis: {
			title: 'tiempo'
		  },
		  yaxis: {
			title: 'potencia'
		  },
		margin: { t: 0 } } );
		TESTER.on('plotly_click', function(data){
		  var pts = '';
		  var time = 0;
			for(var i=0; i < data.points.length; i++){
				pts = 'Tiempo seleccionado = '+data.points[i].x;
				time = data.points[i].x;
			}
			tiemposelect = time;
		  //alert(pts);
		});
	  coordenadasXY = []; 
	  finalizo = true;
	  }
	  );
	  if(mySound.isPlaying()){
		coordenadasXY.push({time : tiempoactual , power : round(potencia)});
		pointsX.push(tiempoactual);
		pointsY.push(round(potencia));
		console.log("Tamaño arreglo: " + coordenadasXY.length + " j: " + j);
	  }
	  
	  isMouseOverCanvas();
	  j++;

	}

	function isMouseOverCanvas() {
	  var mX = mouseX, mY = mouseY;
	  if (mX > 0 && mX < width && mY < height && mY > 0) {
		  console.log("Mouse sobre grafica");
	  } 
	}



	function runSketch(sketch) {
		if (typeof p5Sketch !== 'undefined') {
			p5Sketch.remove();
		}

		p5Sketch = new p5(sketch, "sketchContainer");
	}

    </script>

    <!-- Solo permite crear un espacio debajo del botón para que se vea mejor. -->
    <div style="margin: 4%">
    </div>
</body>
</html>
