<?php
    require_once("util.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodeShare</title>

    <link rel="stylesheet" href="styles/default.css">
    <script src="scripts/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/main.js"></script>

</head>
<body>
    <h1><a href="index.php">CodeShare</a></h1>
    <div id="header">
        <?php
            if(isset($_SESSION["userid"])){
                echo '<a href="index.php">Main Page</a> ';
                echo '<a href="profile.php">Profile</a> ';
                echo '<a href="code.php" id="post">Post</a> ';
                
                echo '<a id="logout" href="login.php">Logout</a> ';
            }else{
                include("login_form.php");
            }
        ?>
    </div>
    <div id="body">