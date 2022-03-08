<?php
header("Content-Type: application/json");

if (isset($_GET["song_id"])) {
    require_once "kommentare_anzeigen.php";

    $json = kommentare_anzeigen($_GET["song_id"], isset($_GET["k_id"]) ? $_GET["k_id"] : NULL);

    echo $json;
} else {
    echo "[]";
}

