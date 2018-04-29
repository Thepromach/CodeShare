<?php

session_start();

//NOTE: change username and password
$conn = new mysqli('127.0.0.1', 'root', '', 'CodeShare');

if(mysqli_connect_errno()){
    die("Connection to database failed" .  mysqli_connect_error());
}


//Random string generator
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//Creates default code block
function codeBlock($id, $title, $language, $code){
    echo '<div class="code"><h2><a href="code.php?id='. $id .'">'. $title .'</a></h2>';
    echo '<pre><code class="'. $language .'">'. htmlspecialchars($code) .'</code></pre></div>';
}


//delete post that belongs to user
function deletePost($id, $userid, $conn){
    $sql_command = "DELETE FROM Code WHERE Id=". $id . "&& UserId=" . $userid .";";
    if($conn->query($sql_command)){  
        echo "<p>Code snipped deleted</p>";
    }else{
        echo '<p id="error">Failed to delete code snipped</p>';
    }
}

//create user with name and pass
function createUser($name, $pass, $conn){
    $salt = generateRandomString(32);
    $hashed_password = hash("sha256", $salt . $pass); //One way hashing

    $sql_command = "INSERT INTO User (Name, Password, Salt)".
    " VALUES('" . $name . "','" . $hashed_password . "','" . $salt . "');";

    if($conn->query($sql_command)){
            
        return true;

    }

    return false;
}

function codeBlockWithDelete($id, $title, $language, $code){
    echo '<div class="code"><h2><a href="code.php?id='. $id .'">'. $title .'</a> <a id="delete" href="delete.php?id='. $id .'">X</a></h2>';
    echo '<pre><code class="'. $language .'">'. htmlspecialchars($code) .'</code></pre></div>';
}

?>