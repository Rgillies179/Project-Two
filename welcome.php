<?php
require_once "config.php";
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


// POSTS GO HERE
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, Welcome to our site.</h1>
    <p>
        <a href="addPost.php" class="btn btn-success">Add a Post</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    
    <?php


    $email1 =  htmlspecialchars($_SESSION["email"]);
    $query = "SELECT user_id FROM users WHERE email = '".$email1."'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $temp = $row['user_id'];
    
   $query = "SELECT * FROM posts WHERE user_id = '".$temp."'";
   $result = mysqli_query($link, $query);
    while ($row = $result->fetch_assoc()) {
        echo $row['image']."<br>";
        echo  $row['title']."<br>";
        echo  $row['textboxContent']."<br>";
    }



    ?>
</body>
</html>