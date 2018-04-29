<?php
/**
 * Created by PhpStorm.
 * User: YERFER
 * Date: 28/04/2018
 * Time: 10:52 PM
 */

include('session.php');


 $msg="";
    $codigoAnotacion = $_REQUEST["codigo"];
    $sql = "DELETE FROM anotacion WHERE anotacion.id=$codigoAnotacion";
    if (mysqli_query($db, $sql)) {
        $msg = "Anotación eliminada Satisfactoriamente!";
    } else {
        $msg = "Error: " . $sql . "<br>" . mysqli_error($db);
    }
    echo "<script>alert('$msg');</script>";
?>