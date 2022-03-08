<?php
session_start();
require_once "../database.php";


if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === TRUE || (isset($_SESSION["is_Admin"]) && $_SESSION["is_Admin"] === "1")) {
    if (isset($_SESSION["User_ID"]) && isset($_GET["ID"]) && ($_GET["ID"] == $_SESSION["User_ID"])) {

        $del = "DELETE FROM user WHERE `PK_User_ID` = :id;";
        $prepare = $pdo->prepare($del);

        $prepare->bindValue(":id", $_GET["ID"]);
        if ($prepare->execute()) {
            header("Location: logout.php");
        } else {
            echo "cc";
        }
    } else {
        echo "<form method='post' action='../index.php'>
    <input type='submit' value='Zurück'> </form>";
        echo "Um einen Benutzer löschen zu können, müssen Sie Administratorrechte haben.";
    }
}
// }
