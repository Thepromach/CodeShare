<?php

session_start();

//TODO: change username and password
$conn = new mysqli('127.0.0.1', 'root', '', 'CodeShare');

if(mysqli_connect_errno()){
    die("Connection to database failed" .  mysqli_connect_error());
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function codeBlock($id, $title, $language, $code){
    echo '<div class="code"><h2><a href="code.php?id='. $id .'">'. $title .'</a></h2>';
    echo '<pre><code class="'. $language .'">'. htmlspecialchars($code) .'</code></pre></div>';
}


?>