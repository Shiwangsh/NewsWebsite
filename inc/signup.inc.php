<?php

// checks if there is a post request sent by register_btn which is of type submit
if (isset($_POST["register_btn"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $userType = "user";
    $name = $_POST["name"];

    require_once '../DB/dbh.inc.php';
    require_once '../functions/functions.inc.php';
    // validation for various checks

    if (isEmpty($name, $username, $email, $password, $confirm_password) !== false) {
        header('location: ../phpages/signup.php?error=isEmpty');
        exit();
    }
    if (invalidUser($username) !== false) {
        header('location: ../phpages/signup.php?error=invalidUser');
        exit();
    }
    if (invalidEmail($email) !== false) {
        header('location: ../phpages/signup.php?error=invalidEmail');
        exit();
    }
    if (inValidPassword($password, $confirm_password) !== false) {
        header('location: ../phpages/signup.php?error=inValidPassword');
        exit();
    }
    if (userExists($conn, $username, $email) !== false) {
        header('location: ../phpages/signup.php?error=userAlreadyExists');
        exit();
    }
    // if all checks pass createUser
    createUser($conn, $name, $username, $email, $password, $userType);
} else {
    // else send back to signup page
    header('location: ../phpages/signupPage.php');
    exit();
}
