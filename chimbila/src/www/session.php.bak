<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$db = mysqli_connect("localhost:3306", "root", "","chimbilaDB") or die('Error en conexion a la DB');
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($db,"select id,email,nickname from usuario where email='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session=$row['nickname'];
$identificacion=$row['id'];
if(!isset($login_session)){
header('Location: index.php'); // Redirecting To Home Page
}
?>