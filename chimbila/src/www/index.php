<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: audios.php");
}
?>

<!DOCTYPE html>
<html>
   
   <head>
      <title>CHIMBILA - Anotador de sonidos de murciélagos</title>
      <link href="css/style.css" rel="stylesheet" type="text/css">      
   </head>
   
   <body>

	<div id="main">

      <h1>CHIMBILA<br><br>Anotador de sonidos de murciélagos</h1>
      <div id="login">
         <h2>Inicio de Sesión</h2>
               <form action = "" method = "post">
                  <label for="name" >Email  :</label><input id="name" type = "text" name = "username"  placeholder="usuario@mail.com" class = "box" required/><br /><br />
                  <label for="password">Contrase&#241;a  :</label><input id="password" type = "password" name = "password" placeholder="**********" class = "box" required/><br/><br />
                  <input type = "submit" name="submit" value = " Login "/><br />
                  <span><?php echo $error; ?></span>
               </form>     
         </div>
        <div align="center" style="margin-top: 10px;">
            <div>
                <!-- Agrega la imagen enlazando desde la virtual2, configurado para varios tipos de pantallas  -->
                <picture>
                    <source
                            media="(min-width: 650px)"
                            srcset="http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png,
                            http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png 1.5x,
                            http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png 2x">
                    <source
                            media="(min-width: 465px)"
                            srcset="http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png,
                            http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png 1.5x
                            http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png 2x">
                    <img
                            src="http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png"
                            srcset="http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png 1.5x,
                            http://virtual2.unillanos.edu.co/imagenes/unillanos_logo.png 2x"
                            alt="Unillanos Logo">
                </picture>
            </div>
            <div>
                <label>Universidad de lo Llanos - Unillanos</label><br/>
                <label>2018</label>
            </div>

        </div>
      </div>

    <br/>


   </body>
</html>