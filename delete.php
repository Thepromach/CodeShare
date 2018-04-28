

<?php

require("header.php");


if(isset($_GET["id"]) && isset($_SESSION["userid"])){
    $sql_command = "DELETE FROM Code WHERE Id=". $_GET["id"] . "&& UserId=" . $_SESSION["userid"] .";";
    if($conn->query($sql_command)){  
        echo "<p>Code snipped deleted</p>";
    }else{
        echo '<p id="error">Failed to delete code snipped</p>';
    }

}else{

    echo '<p id="error">No Id was given</p>';
}

require("footer.php");
?>