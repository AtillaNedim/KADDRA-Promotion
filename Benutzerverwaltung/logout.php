<?php
session_start();

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === TRUE) {
    session_start();
    session_unset();
    session_destroy();
    setcookie(session_name(), "", 0, "/");
    header("Location: ../index.php ");
} else {
    echo "Please <a href='login.php' >log in</a>  first";
}
