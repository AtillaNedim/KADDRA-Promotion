<?php
session_start();
require_once "../../database.php";
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == True) {

    if (isset($_POST["btn"]) && isset($_POST["tea"]) && isset($_POST["zeit"])) {

        $insert = "INSERT INTO `kommentare` (`datum` , `inhalt`, `FK_PK_Song_ID`, `FK_PK_User_ID`) VALUES (:zeit, :inhalt, :FK_PK_Song_ID, :FK_PK_User_ID);";
        $insert_stmt = $pdo->prepare($insert);

        $insert_stmt->bindParam(":zeit", $_POST["zeit"]);
        $insert_stmt->bindParam(":inhalt", $_POST["tea"]);
        $insert_stmt->bindParam(":FK_PK_Song_ID", $_POST["FK_PK_Song_ID"]);
        $insert_stmt->bindParam(":FK_PK_User_ID", $_SESSION["User_ID"]);

        if ($insert_stmt->execute()) {
            // TODO: Erfolgsmeldung?
            header("Location: ../../song/songs.php?ID=".$_POST["FK_PK_Song_ID"]."");

        } else {
            header("Location: ../login.php");

            // TODO: Fehlermeldung
        }
        // $insert_stmt->debugDumpParams();
    } else {
        header("Location: ../login.php");

        // TODO: Fehlermeldung
    }
} else {
    header("Location: ../login.php");
}
