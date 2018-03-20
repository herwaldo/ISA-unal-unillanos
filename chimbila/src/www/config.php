<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'chimbilaDBUser');
   define('DB_PASSWORD', 'Ch1mb1');
   define('DB_DATABASE', 'chimbilaDB');
   echo DB_SERVER.", ".DB_USERNAME.", ".DB_PASSWORD.", ".DB_DATABASE;
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die('Error en conexion a la DB');
    session_start();// Starting Session
    // Storing Session
    $user_check=$_SESSION['login_user'];
    // SQL Query To Fetch Complete Information Of User
    $ses_sql=mysqli_query($db,"select email,nickname from usuario where email='$user_check'");
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session =$row['nickname'];
    echo $login_session;
?>