<?php
include('session.php');

$nombre=$_POST['NameSubColeccion'];
$subNivel=$_POST['SubColeccion_select'];

$sql="INSERT INTO `jerarquia`(`nombre_coleccion`, `antecesor_id`, `usuario_id`) VALUES ('".$nombre."',".$subNivel.",".$identificacion.")";

mysqli_query($db,$sql);
echo "<br> Agregado exitosamente";

?>