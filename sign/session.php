<?php
session_start();
require_once "csv_util.php";
if (count($_POST)) {
    if (checkUser($_POST["uName"], $_POST["pWord"])) {
        $_SESSION["uName"] = $_POST["uName"];
        $_SESSION["mod"] = true;
        echo "ping";
        print_r($_SESSION);
        header("Location: ../quotes/index.php");
    } else if ($_POST["email"]) {
        if (newCheck($_POST["email"], $_POST["uName"], $_POST["pWord"])) {
            $_SESSION["uName"] = $_POST["uName"];
            $_SESSION["mod"] = true;
    }
        header("Location: ./index.php");
    } else {
        $_SESSION["uName"] = "undefined";
        $_SESSION["mod"] = false;
        header("Location: ./in.php?error=true");
    }
} else {
    header("Location: ./in.php?error=true");
}
