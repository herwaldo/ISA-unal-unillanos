<?php
include('session.php');

$nombre=$_POST['NameColeccion'];

$sql="INSERT INTO `jerarquia`(`nombre_coleccion`, `antecesor_id`, `usuario_id`) VALUES ('".$nombre."',0,".$identificacion.")";

mysqli_query($db,$sql);
echo "<br> Agregado exitosamente";

?>