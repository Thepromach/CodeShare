
<?php
    require("header.php");


    if(isset($_SESSION["user"])){
        echo '<h2 id="username">'. $_SESSION["user"] .'</h2>';

        if(isset($_SESSION["userid"])){ //Making sure that userid exist

            $sql_command = "SELECT Id, Title, Language, Code FROM Code WHERE UserId=". $_SESSION["userid"] ." ORDER BY Id DESC LIMIT 10;";
            $result = $conn->query($sql_command);
    
            if($result->num_rows > 0){
    
                while($row = $result->fetch_assoc()){
                    codeBlockWithDelete($row["Id"], $row["Title"], $row["Language"], $row["Code"]);
                }
            }else{
                echo "You don't have any snippers";
            }
    
        }
        else{
            echo '<p id="error">Error no userid found</p>';
        }
    }else{
        echo '<h2 id="username">You are not logged on</h2>';  
    }

    


    require("footer.php");
?>