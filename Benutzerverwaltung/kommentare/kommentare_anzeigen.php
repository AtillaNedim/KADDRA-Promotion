<?php

function kommentare_anzeigen($song_id, $kommentare_id)
{

    require_once "./../../database.php";

    $select = "SELECT * FROM kommentare JOIN user ON user.PK_User_ID = kommentare.FK_PK_User_ID WHERE (FK_PK_Song_ID = :s_id OR :s_id is NULL)";
    if (is_null($kommentare_id)) {
        $select .= " AND (kommentare.FK_PK_Kommentar_ID IS :k_id)";
    } else {
        $select .= " AND (kommentare.FK_PK_Kommentar_ID = :k_id)";
    }
    $select_stmt = $pdo->prepare($select);

    $select_stmt->bindValue(":s_id", $song_id);
    $select_stmt->bindValue(":k_id", $kommentare_id);

    $kommentare = array();

    if ($select_stmt->execute()) {

        while (($record = $select_stmt->fetch()) != FALSE) {
            $object = new stdClass();
            $object->username = htmlspecialchars($record["username"]);
            $object->datum = htmlspecialchars($record["datum"]);
            $object->inhalt = htmlspecialchars($record["inhalt"]);
            $object->PK_Kommentare_ID = htmlspecialchars($record["PK_Kommentare_ID"]);
            $object->FK_PK_Kommentar_ID = htmlspecialchars($record["FK_PK_Kommentar_ID"]);
            $object->FK_PK_Song_ID = htmlspecialchars($record["FK_PK_Song_ID"]);

            array_push($kommentare, $object);
        }
        
    } else {

        $select_stmt->debugDumpParams();
    }

    return json_encode($kommentare);
}
