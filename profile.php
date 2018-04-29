
<?php
    require("header.php");

    if(isset($_POST["password"])){

        if(isset($_SESSION["userid"])){
            updatePassword($_POST["password"], $conn);
        }else{
            echo '<p id="error">'. "Can't change when your not login" .'</p>';
        }
        
    }

    if(isset($_SESSION["user"])){

        if(isset($_GET["edit"])){
            echo '<div id="left">';
            echo '<form action="profile.php" method="Post">';
            echo '<p>New password: <input type="password" name="password"></input></p>';
            echo '<button type="submit">Update</button>';
            echo '</form>';
        }
        else{
            echo '<h2 id="username">'. $_SESSION["user"] .' <a id="pass" href="profile.php?edit"> Change Password</a></h2>';

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
        }        
    }else{
        echo '<h2 id="username">You are not logged on</h2>';  
    }

    


    require("footer.php");
?>