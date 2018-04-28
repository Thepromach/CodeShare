
<?php
    require("header.php");


    if(isset($_SESSION["user"])){
        echo '<h2 id="username">'. $_SESSION["user"] .'</h2>';
    }

    function codeBlockWithDelete($id, $title, $language, $code){
        echo '<div class="code"><h2><a href="code.php?id='. $id .'">'. $title .'</a> <a id="delete" href="delete.php?id='. $id .'">X</a></h2>';
        echo '<pre><code class="'. $language .'">'. htmlspecialchars($code) .'</code></pre></div>';
    }
    
    


    if(isset($_SESSION["userid"])){

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
        echo "You are not logged on";
    }


    require("footer.php");
?>