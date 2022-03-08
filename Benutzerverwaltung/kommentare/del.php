<?php
session_start();
require_once "./../../database.php";
require_once "../login_check.inc.php";


?>
<form method="POST" action="../ ">
    <input type="submit" value="zurück">
</form>

<?php
if (isset($_GET["ID"])) {
    $DELETE = "DELETE FROM `kommentare` WHERE `PK_Kommentare_ID` = :id AND (FK_PK_User_ID = :uid OR :isadmin = TRUE);";
    $prepare = $pdo->prepare($DELETE);

    $prepare->bindParam(":id", $_GET["ID"]);
    $prepare->bindParam(":uid", $_SESSION["User_ID"]);
    $prepare->bindParam(":isadmin", $_SESSION["is_Admin"]);

    if ($prepare->execute()) {
        header("Location: ../../song.php?ID=".$_GET["S_ID"]);
    }
    // echo $_GET["ID"];
} else {

    echo "error: Bei execute";
}
?>