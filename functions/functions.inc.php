<?php
// validation checking functions that takes in data from the forms and operates on them
function isEmpty($name, $username, $email, $password, $confirm_password)
{
    if (empty($username) || empty($password) || empty($password) || empty($confirm_password) || empty($name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidUser($username)
{
    if (!preg_match("/^[A-Za-z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidPassword($password, $confirm_password)
{
    if ($password !== $confirm_password) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// checks if user exists on database
function userExists($conn, $username, $email)
{
    // decalre a sql statement we want to use
    $sql = "SELECT * from users WHERE username = ? OR email = ?;";
    $statement = mysqli_stmt_init($conn);
    // pass the connection to the statement variable
    if (!mysqli_stmt_prepare($statement, $sql)) {
        // if preparing the statement failed 
        header('location: ../phpages/signup.php?error=stmtfailed');
        exit();
    }
    // else bind params
    mysqli_stmt_bind_param($statement, 'ss', $username, $email);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
    }
    mysqli_stmt_close($statement);
    return $result;
}
// create user 
function createUser($conn, $name, $username, $email, $password, $userType)
{
    $sql = "INSERT INTO users(name,username,email,password,userType) VALUES(?,?,?,?,?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/signup.php?error=stmtfailed');
        exit();
    }
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// bind parameters to the statement to prevent sql injection in sites
    mysqli_stmt_bind_param($statement, 'sssss', $name, $username, $email, $password, $userType);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../phpages/signup.php?error=none");
    exit();
}
function isEmptyLogin($username, $password)
{
    if (empty($username) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
// login 
function login($conn, $username, $password)
{
    // checks if user already exists
    $userExists = userExists($conn, $username, $username);
    if ($userExists === false) {
        // if it doesnt
        header("location: ../phpages/login.php?error=userNotFound");
        exit();
    }
    // 
    $db_pass = $userExists["password"];
    // checks password against the one store in the database
    // $checkPassword = password_verify($password, $hashedPassword);
    if ($db_pass !== $password) {
        header("location: ../phpages/login.php?error=incorrectPassword");
        exit();
    } else if ($db_pass == $password) {
        session_start();
        $_SESSION["userID"] = $userExists["userID"];
        $_SESSION["username"] = $userExists["username"];
        $_SESSION["userType"] = $userExists["userType"];
        $_SESSION["name"] = $userExists["name"];
        $_SESSION["loggedIn"] = true;

        if (isset($_SESSION["userType"])) {
            if ($_SESSION["userType"] == "admin") {
                header("location: ../phpages/admin.php");
                exit();
            } else {
                header("location: ../phpages/index.php");
                exit();
            }
        }
        exit();
    }
}
