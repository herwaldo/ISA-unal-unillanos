<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: annotator.php");
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
      </div>
    <br/>
    <div align="center">
        <label>Universidad de lo Llanos - Unillanos</label><br/>
        <label>2018</label>

    </div>

   </body>
</html>