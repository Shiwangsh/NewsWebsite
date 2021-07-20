<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once '../DB/dbh.inc.php';
    require_once '../functions/functions.inc.php';
// checks if the login is empty
    if (isEmptyLogin($username, $password) !== false) {
        header('location: ../phpages/login.php?error=isEmpty');
        exit();
    }
    // if not then log in
    login($conn, $username, $password);
} else {
    // else
    header("location: ../phpages/login.php");
    exit();
}
