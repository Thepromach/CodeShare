

<?php

require("header.php");


if(isset($_GET["id"]) && isset($_SESSION["userid"])){
    deletePost($_GET["id"], $_SESSION["userid"], $conn);
}else{
    echo '<p id="error">No Id was given or not login</p>';
}




require("footer.php");
?>