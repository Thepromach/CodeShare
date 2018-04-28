<?php
    require("header.php");

    $sql_command = "SELECT Id, Title, Language, Code FROM Code ORDER BY Id DESC LIMIT 10;";
    $result = $conn->query($sql_command);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            codeBlock($row["Id"],$row["Title"], $row["Language"], $row["Code"]);

            /*echo '<div id="code"><h2>'. $row["Title"] .'</h2>';
            echo '<span id="'. $row["Language"].'">'. $row["Code"].'</span></div>';*/
        }
    }
    else{
        for($i = 0; $i < 10; $i++)
        {
            echo '<div id="code"><h2>Title</h2>';
            echo '<span>Hello</span></div>';
        }
    }
    
    require("footer.php");
?>
