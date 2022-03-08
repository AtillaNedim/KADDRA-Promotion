<?php
session_start();

$t = time();
require_once "./../../database.php";
require_once "../login_check.inc.php";


if (isset($_SESSION["message"])) {
    echo $_SESSION["message"];
    unset($_SESSION["message"]);
    $count = FALSE;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <link rel="stylesheet" href="../../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kommentare</title>
</head>

<body>
    <?php
    // INSERT COMMENT
    if (isset($_POST["btn"]) && isset($_POST["tea"]) && isset($_POST["zeit"])) {

        $insert = "INSERT INTO `kommentare` (`datum` , `inhalt`, `FK_PK_Song_ID`, `FK_PK_User_ID`) VALUES (:zeit, :inhalt, :FK_PK_Song_ID, :FK_PK_User_ID);";
        $insert_stmt = $pdo->prepare($insert);

        $insert_stmt->bindParam(":zeit", $_POST["zeit"]);
        $insert_stmt->bindParam(":inhalt", $_POST["tea"]);
        // $insert_stmt->bindParam(":ist_antwort", $_POST["ist_antwort"]);
        $insert_stmt->bindParam(":FK_PK_Song_ID", $_POST["FK_PK_Song_ID"]);
        $insert_stmt->bindParam(":FK_PK_User_ID", $_SESSION["User_ID"]);

        if ($insert_stmt->execute()) {

            // TODO: Erfolgsmeldung?
        } else {
            // TODO: Fehlermeldung
        }
        // $insert_stmt->debugDumpParams();
    }
    ?>
    <form method="post" action="../../">
        <input type="submit" id="zurück-btn" value="<-- zurück">
    </form><br />
    <form method="POST">
        <textarea id="textarea" name="tea" rows="4" cols="50"></textarea>
        <input type="hidden" name="zeit" value="<?php echo (date("Y-m-d:H-i", $t)); ?>"> <br />
        <input type="submit" name="btn" value="senden">
    </form> <br />

    <?php
    // SHOW ALL COMMENTS

    $select = "SELECT * FROM kommentare JOIN user ON user.PK_User_ID = kommentare.FK_PK_User_ID";
    $select_stmt = $pdo->prepare($select);


    if ($select_stmt->execute()) {
        echo "<table><br /> <tr>
                <th>Wer</th>
                <th>Wann</th>
                <th>Was </th>
                <th>ID </th>
                <th>edit</th></tr>\n";

        while (($record = $select_stmt->fetch()) != FALSE) {
            echo "<tr> <td>" . htmlspecialchars($record["username"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["datum"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["inhalt"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["PK_Kommentare_ID"]) . "</td>\n";
            if ($record["FK_PK_User_ID"] == $_SESSION["User_ID"] || $_SESSION["is_Admin"] == "1") {

                echo "<td ><div class='dropdown'><span>edit</span>";
                echo "<div class='dropdown-content'>";
                echo "<a href='kommentar_upd.php?K_ID=" . $record["PK_Kommentare_ID"] . "&B_ID=" . $record["PK_User_ID"] . "'>bearbeiten<br /> <br /> </a>";
                echo "<a href='del.php?ID=" . $record["PK_Kommentare_ID"] . "'>löschen</a>";
                echo "</div></div></td> ";
            }
        }
        echo " </tr> </table>";
    }
    ?>
</body>

</html>