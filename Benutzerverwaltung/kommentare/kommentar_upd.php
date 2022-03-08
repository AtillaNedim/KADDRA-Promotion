<?php
session_start();
require_once "./../../database.php";
require_once "../login_check.inc.php";


//speichern eines Updates
if (isset($_POST["b_inhalt"]) && isset($_POST["PK_Kommentare_ID"])) {
    $statement = "UPDATE `kommentare` SET `inhalt` = :inhalt WHERE `kommentare`.`PK_Kommentare_ID` = :id;";
    $update_stmt = $pdo->prepare($statement);
    $update_stmt->bindParam(":inhalt", $_POST["b_inhalt"]);
    $update_stmt->bindParam(":id", $_POST["PK_Kommentare_ID"]);


    if ($update_stmt->execute()) {
        $_SESSION["message"] = "Ihr Kommentar konnte erfolgreich geändert werden";
        header("Location: ../../song.php?ID=" . $_GET["S_ID"]);
    } else {
        echo "Kommentar konnte nicht geändert werden!";
    }
}

//laden und anzeigen!
if (isset($_GET["S_ID"]) && isset($_GET["K_ID"]) && isset($_GET["B_ID"]) && ($_GET["B_ID"] == $_SESSION["User_ID"] || $_SESSION["is_Admin"] == "1")) {

    $select = "SELECT inhalt, PK_Kommentare_ID FROM`kommentare` WHERE `kommentare`.`PK_Kommentare_ID` = :id;";
    $select_stmt = $pdo->prepare($select);
    $select_stmt->bindParam(":id", $_GET["K_ID"]);
    if ($select_stmt->execute()) {
        if (($record = $select_stmt->fetch()) != FALSE) {


?>

            <!DOCTYPE html>
            <html lang="de">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Kommentare bearbeiten</title>
            </head>

            <body>
                <form method="post" action="../">
                    <input type="submit" id="zurück-btn" value="<-- zurück">
                </form><br />
                <form method="POST">
                    <input type="hidden" name="PK_Kommentare_ID" value="<?php echo $record["PK_Kommentare_ID"]; ?>">
                    <textarea id="textarea" name="b_inhalt" rows="4" cols="50"><?php echo $record["inhalt"]; ?></textarea><br />
                    <input type="submit" value="bearbeitung speichern"><br />
                </form>
            </body>

            </html>
<?php
        }
    }
} else {
    echo "<a href='kommentare.php' > Sorry, an error has occurred please reload the page here!</a> ";
}
?>