

<?php

require("header.php");


if(isset($_GET["id"])){
    $sql_command = "SELECT Title, Language, Code FROM Code WHERE Id=". $_GET["id"] .";";
    $result = $conn->query($sql_command);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            codeBlock($_GET["id"], $row["Title"], $row["Language"], $row["Code"]);
        }
    }
}
else if(isset($_POST["Code"]) && $_SESSION["userid"]){
    $sql_command = "INSERT INTO Code (Title, UserId, Language, Code)".
            " VALUES('". htmlspecialchars($_POST["Title"]) ."', '". $_SESSION["userid"] ."' , '" . htmlspecialchars($_POST["Language"]) ."', '". htmlspecialchars($_POST["Code"]) ."')";

    if($conn->query($sql_command)){
        echo "Success";
    }else{
        echo "Fail";
    }
}else{

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
    <div id="right">
        <!--<h2>Review</h2>-->
    </div>

<?php


} 

require("footer.php");
?>