<?php
session_start();
require_once "../database.php";

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === TRUE) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UserAddByAdmin</title>
    </head>

    <body>
        <form method='post' action='profile.php'><input type='submit' value='Zurück'></form>
        <form method="POST">
            <label> Username:</label>
            <input type="text" name="us" placeholder="Username" required> <br /> <br />
            <label> Vorname:</label>
            <input type="text" name="vn" placeholder="Vorname"> <br /> <br />
            <label> Nachname:</label>
            <input type="text" name="nn" placeholder="Nachname"> <br /> <br />
            <label> Password(HASH):</label>
            <input type="text" name="pw" placeholder="Password(HASH)" required>
            <a href="https://phppasswordhash.com/">Password mit Hash-Wert erstellen.</a> <br /> <br />
            <label> Member_Seit_Datum:</label>
            <input type="date" name="msd" placeholder="Member_Seit_Datum" required> <br /> <br />
            <label> E-Mail:</label>
            <input type="email" name="em" placeholder="E-Mail" required> <br /> <br />
            <label> Verify_Number:</label>
            <input type="number" min="1000" max="9999" name="vnb" placeholder="Verify_Number" required> <br /> <br />
            <label> Description:</label>
            <input type="text" name="dc" placeholder="Description"> <br /> <br />
            <label> Background_Picture:</label>
            <input type="file" name="bp" placeholder="Background_Picture"> <br /> <br />
            <label> Profile_Picture:</label>
            <input type="file" name="pp" placeholder="Profile_Picture"> <br /> <br />
            <label> ist_Verify_User:</label>
            <input type="number" min="0" max="1" name="ivu" placeholder="ist_Verify_User"> <br /> <br />
            <input type="submit" value="ADD_User">
        </form>
    <?php


    if (isset($_POST["us"]) && isset($_POST["pw"]) && isset($_POST["msd"]) && isset($_POST["em"]) && isset($_POST["vnb"])) {
        // $pdo = new PDO("mysql:host=localhost;dbname=KADDRA_Promotion;port=3306", "root");
        $insert = "INSERT INTO `user` (`username`, `vorname`, `nachname`, `passwortHASH`, `member_seit_Datum`, `email`, `verify_number` , `description`, `background_picture`, `profile_picture`, `ist_verifyed_user`) VALUES (:us, :vn, :nn, :pw, :msd, :em, :vnb, :dc, :bp, :pp, :ivu);";
        $prepare = $pdo->prepare($insert);

        $prepare->bindParam(":us", $_POST["us"]);
        if (isset($_POST["vn"])) {
            $prepare->bindParam(":vn", $_POST["vn"]);
        }
        if (isset($_POST["nn"])) {
            $prepare->bindParam(":nn", $_POST["nn"]);
        }
        $prepare->bindParam(":pw", $_POST["pw"]);
        $prepare->bindParam(":msd", $_POST["msd"]);
        $prepare->bindParam(":em", $_POST["em"]);
        $prepare->bindParam(":vnb", $_POST["vnb"]);
        if (isset($_POST["dc"])) {
            $prepare->bindParam(":dc", $_POST["dc"]);
        }
        if (isset($_POST["bp"])) {
            $prepare->bindParam(":bp", $_POST["bp"]);
        }
        if (isset($_POST["pp"])) {
            $prepare->bindParam(":pp", $_POST["pp"]);
        }
        if (isset($_POST["ivu"])) {
            $prepare->bindParam(":ivu", $_POST["ivu"]);
        }

        if ($prepare->execute()) {
            header("Location: profile.php");
        } else {
            echo "ERROR";
        }
    }
} else {
    echo "Please <a href='login.php' >log in</a>  first";
}
    ?>
    </body>

    </html>