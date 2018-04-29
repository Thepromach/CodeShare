<?php
    require("header.php");

    $sql_command = "SELECT Id, Title, Language, Code FROM Code ORDER BY Id DESC LIMIT 10;";
    $result = $conn->query($sql_command);

    if(!$result){
        echo '<p id="error">Failed to get any post from database</p>';
    }

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            codeBlock($row["Id"],$row["Title"], $row["Language"], $row["Code"]);
        }
    }
    
    require("footer.php");
?>
