<?php
    require("header.php");

    //select 10 newest codes
    $sql_command = "SELECT Id, Title, Language, Code FROM Code ORDER BY Id DESC LIMIT 10;";
    $result = $conn->query($sql_command);

    //test if result isn't null
    if(!$result){
        echo '<p id="error">Failed to get any post from database</p>';
    }
    else if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            codeBlock($row["Id"],$row["Title"], $row["Language"], $row["Code"]);
        }
    }
    
    require("footer.php");
?>
