<?php
   session_start(); // Starting Session
   $error=''; // Variable To Store Error Message
   if (isset($_POST['submit'])) {
      if (empty($_POST['username']) || empty($_POST['password'])) {
         $error = "Email o Password sin completar";
      }
      else
      {
         // Define $username and $password
         $username=$_POST['username'];
         $password=$_POST['password'];
         // Establishing Connection with Server by passing server_name, user_id and password as a parameter
         $db = mysqli_connect("localhost:3306", "root", "","chimbilaDB");
         // To protect MySQL injection for Security purpose
         $username = stripslashes($username);
         $password = stripslashes($password);
         $username = mysqli_real_escape_string($db,$username);
         $password = mysqli_real_escape_string($db,$password);

         // SQL query to fetch information of registerd users and finds user match.
         $query = mysqli_query($db,"select * from Users where password='$password' AND email='$username'");
         $rows = mysqli_num_rows($query);
         if ($rows == 1) {
         $_SESSION['login_user']=$username; // Initializing Session
         header("location: profile.php"); // Redirecting To Other Page
         } else {
         $error = "Email o Password erróneos";
         }
         
      }
   }
?>