<?php 
session_start();
require_once "./../../database.php";


if(isset($_SESSION["User_ID"]) && isset($_POST["message"]) && isset($_POST["parent_kommentar_id"]) && isset($_POST["song_id"])){
$t = time();
    

    $insert = "INSERT INTO `kommentare` (`datum` , `inhalt`, `FK_PK_Song_ID`, `FK_PK_User_ID`,`FK_PK_Kommentar_ID`) VALUES (:zeit, :inhalt, :FK_PK_Song_ID, :FK_PK_User_ID, :FK_PK_Kommentar_ID);";
    $insert_stmt = $pdo->prepare($insert);

    $insert_stmt->bindValue(":zeit", date("Y-m-d:H-i", $t));
    $insert_stmt->bindParam(":inhalt", $_POST["message"]);
    $insert_stmt->bindParam(":FK_PK_Song_ID", $_POST["song_id"]);
    $insert_stmt->bindParam(":FK_PK_User_ID", $_SESSION["User_ID"]);
    $insert_stmt->bindParam(":FK_PK_Kommentar_ID", $_POST["parent_kommentar_id"]);


    if ($insert_stmt->execute()) {
        echo "alles OK :)";
        // TODO: Erfolgsmeldung?
    } else {
        echo "alles NICHT OK :.(";

        // TODO: Fehlermeldung
    }
    
}
