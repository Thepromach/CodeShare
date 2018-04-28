<?php

require("header.php");

$username = $_POST["username"];
$password = $_POST["password"];

if(isset($_POST["register"])){
    register($conn, htmlspecialchars($username), $password);
}elseif(isset($_POST["login"])){
    login($conn, htmlspecialchars($username), $password);
}else{
    session_unset();
    header("Location:index.php");
    exit;
}

require("footer.php");



function register($conn, $name, $pass){
    if(strlen($name) < 1){
        echo '<p id="error">' . "Username can't be empty</p>";
        return;
    }
    if(strlen($pass) < 8){
        echo '<p id="error">Password is under 8 characters</p>';
        return;
    }

    $name =  str_replace(' ', '', $name);
    
    $sql_command = "SELECT Name FROM User WHERE Name='" .htmlspecialchars($name). "';";
    $result = $conn->query($sql_command);

    if($result->num_rows == 0){

        $salt = generateRandomString(32);
        $devkey = generateRandomString(32);
        $hashed_password = hash("sha256", $salt . $pass);

        $sql_command = "INSERT INTO User (Name, Status, Devkey, Password, Salt)".
        " VALUES('" . $name . "', 0, '" . $devkey . "' , '" . $hashed_password . "','" . $salt . "');";
       
        if($conn->query($sql_command)){
            
            login($conn, $name, $pass);

        }
    }else{
        echo '<p id="error">' . "User " . $name . " already exists" . "</p>";
    }
}


function login($conn, $name, $pass){

    if(strlen($name) < 1){
        echo '<p id="error">' . "Username can't be empty</p>";
        return;
    }
    if(strlen($pass) < 8){
        echo '<p id="error">Password is under 8 characters</p>';
        return;
    }
    //echo "hei: " . $name . "||" . $pass;
    $sql_command = "SELECT Salt FROM User WHERE Name='" .htmlspecialchars($name)."';";
    $result = $conn->query($sql_command);
    if($result->num_rows == 1){
        $salt = $result->fetch_array()[0];
        $hashed_password = hash("sha256", $salt . $pass);

        $sql_command = "SELECT Id FROM User WHERE Password='" . $hashed_password ."' AND NAME='". htmlspecialchars($name) ."';";

        $result = $conn->query($sql_command);
        if($result->num_rows == 1){
            $_SESSION["user"] = $name;
            $_SESSION["userid"] = $result->fetch_array()[0];

            header("Location:index.php");
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