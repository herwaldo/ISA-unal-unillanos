<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$db = mysqli_connect("localhost:8989", "root", "root","chimbilaDB");
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($db,"select email from Users where email='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['email'];
if(!isset($login_session)){
header('Location: index.php'); // Redirecting To Home Page
}
?>