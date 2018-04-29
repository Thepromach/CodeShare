<?php
    require("header.php");

    //select 10 newest codes
    $sql_command = "SELECT Id, Title, Language, Code FROM Code ORDER BY Id DESC LIMIT 10;";
    $result = $conn->query($sql_command);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            codeBlock($row["Id"],$row["Title"], $row["Language"], $row["Code"]);
        }
    }
    
    require("footer.php");
?>
