<?php
session_start();
if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["userType"] == "admin") {
        $name =  $_SESSION["name"];
        $text = "Log Out";
    } else {
        header("Location: ../phpages/index.php?erorr=notAdmin");
    }
} else {
    header("Location: ../phpages/index.php?erorr=notAdmin");
}
