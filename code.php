

<?php

require("header.php");


if(isset($_GET["id"])){ //if id is set we find code with id
    $sql_command = "SELECT Title, Language, Code, UserId FROM Code WHERE Id=". $_GET["id"] .";";
    $result = $conn->query($sql_command);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){
            codeBlock($_GET["id"], $row["Title"], $row["Language"], $row["Code"]);
        }
    }
}
else if(isset($_POST["Code"]) && $_SESSION["userid"]){ //if post and code is set Insert new code block
    $sql_command = "INSERT INTO Code (Title, UserId, Language, Code)".
            " VALUES('". htmlspecialchars($_POST["Title"]) ."', '". $_SESSION["userid"] ."' , '" . htmlspecialchars($_POST["Language"]) ."', '". $_POST["Code"] ."')";

    if($conn->query($sql_command)){
        echo "Success";
    }else{
        echo "Failed to ";
    }
}else{ //else code insert form

    echo '<div id="left">';
    echo '<form action="code.php" method="Post">';
    echo '<p>Title: <input type="text" name="Title" id="Title"></input></p>';
    echo '<p>Language: <input type="text" name="Language" id="Language"></input></p>';
    echo '<textarea name="Code" id="Code"></textarea>';
    echo '<button type="submit">Send</button>';
    echo '<button type="button" onclick="View()">View</button>';
    echo '</form>';

?>
    </div>
    <div id="right"> <!--Code Review div-->
    </div>

<?php


} 

require("footer.php");
?>