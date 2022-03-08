<?php
session_start();
require_once "../database.php";

if (isset($_GET["ID"])) {
    $DELETE = "DELETE FROM `song_bewertung` WHERE `FK_PK_user_ID` = :u_id AND (FK_PK_Song_ID = :s_id);";
    $prepare = $pdo->prepare($DELETE);

    $prepare->bindParam(":s_id", $_GET["ID"]);
    $prepare->bindParam(":u_id", $_SESSION["User_ID"]);

    if ($prepare->execute()) {
        header("Location: songs.php?ID=".$_GET["ID"]);
    }
} else {

    echo "error: Bei execute";
}
?>