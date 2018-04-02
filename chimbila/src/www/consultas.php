<?php
include('session.php');

$resultado = mysqli_query($db,"SELECT id,ruta FROM audio");

foreach ($resultado as $key => $value) {
	echo "<br>";
	echo $value['id'];
	echo "<br>";
	echo $value['ruta'];
}

?>