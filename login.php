<?php

require("header.php");

$username = $_POST["username"];
$password = $_POST["password"];

if(isset($_POST["register"])){ //if register request
    register($conn, htmlspecialchars($username), $password);
}elseif(isset($_POST["login"])){ //if login request
    login($conn, htmlspecialchars($username), $password);
}else{ //else we just set user back to index.php
    session_unset();
    header("Location:index.php");
    exit;
}

require("footer.php");



function register($conn, $name, $pass){

    //tests that user name and password are valid
    if(strlen($name) < 1){
        echo '<p id="error">' . "Username can't be empty</p>";
        return;
    }
    if(strlen($pass) < 8){
        echo '<p id="error">Password is under 8 characters</p>';
        return;
    }

    $name =  str_replace(' ', '', $name); //deleting whitespaces from username
    
    $sql_command = "SELECT Name FROM User WHERE Name='" . $name . "';";
    $result = $conn->query($sql_command);

    if($result->num_rows == 0){
        if(createUser($name, $pass, $conn)){
            login($conn, $name, $pass); //login's user and send user back to main page
        }else{
            echo '<p id="error">' . "Failed to create user" . "</p>";
        }
    }else{
        echo '<p id="error">' . "User " . $name . " already exists" . "</p>";
    }
}




function login($conn, $name, $pass){

    //tests that user name and password are valid
    if(strlen($name) < 1){
        echo '<p id="error">' . "Username can't be empty</p>";
        return;
    }
    if(strlen($pass) < 8){
        echo '<p id="error">Password is under 8 characters</p>';
        return;
    }
    $sql_command = "SELECT Salt FROM User WHERE Name='" . $name ."';";
    $result = $conn->query($sql_command);
    if($result->num_rows == 1){
        $salt = $result->fetch_array()[0];
        $hashed_password = hash("sha256", $salt . $pass); //hash

        $sql_command = "SELECT Id FROM User WHERE Password='" . $hashed_password ."' AND NAME='". $name ."';";

        $result = $conn->query($sql_command);
        if($result->num_rows == 1){
            $_SESSION["user"] = $name; //puts user name and id to session data
            $_SESSION["userid"] = $result->fetch_array()[0];

            header("Location:index.php"); //send user to main page
            exit;
        }else{
            echo '<p id="error">Wrong password</p>';
            return;
        }
    }else{
        echo '<p id="error">' . "Couldn't find user named: ". $name ."</p>";
        return;
    }
}



































?>