<?php

session_start();
require_once "../database.php";

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == TRUE) {

    if (isset($_GET["ID"]) && isset($_SESSION["User_ID"])) {
        $upd_like = "INSERT INTO `song_bewertung` (`wert`, `FK_PK_user_ID`, `FK_PK_Song_ID`) VALUES (1, :u_id, :s_id);";
        $statement_upd_like = $pdo->prepare($upd_like);

        // $statement_upd_like->bindParam(":like", $_POST["like"]);
        $statement_upd_like->bindParam(":u_id", $_SESSION["User_ID"]);
        $statement_upd_like->bindParam(":s_id", $_GET["ID"]);


        if ($statement_upd_like->execute()) {
            $statement_upd_like->debugDumpParams();
            echo "<br />" . $_GET["ID"] . "<br />";
            echo $_SESSION["User_ID"];

            echo "<br />a";
            header('Location: songs.php?ID=' . $_GET["ID"]);
        } else {
            $statement_upd_like->debugDumpParams();

            // echo $_POST["like"] . "<br />";
            echo "<br />" . $_GET["ID"] . "<br />";
            echo $_SESSION["User_ID"];

            echo "<br />a";
        }
    } else {
        echo "b";
    }
} else {
    header('Location: ../Benutzerverwaltung/login.php');
}
