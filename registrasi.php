<?php
session_start();
 
 $db = mysqli_connect("localhost","root","oelshop");

 if (isset($_POST['register_btn'])) {
    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $password2 = mysql_real_escape_string($_POST['passwod2']);

    if ($password == $password){
        // create user
        $password= mds ($password); // 
        mysqli_query($db, $sql);
        $_SESSION['message'] = "you are now logged in";
        $_SESSION['username'] = $username;
        header("location: menu.php"); // redirect to home page
    }else{
        $_SESSION['massage'] = 
    }
 }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
     <title>Register login logout</title>
 </head>
 <body>
    <div class="header">
        <h1>Register</h1>
    </div>
 
 </body>
 </html>