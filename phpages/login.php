<?php
session_start();
// echo ;
// sesson check to see if user is already signd in
if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["loggedIn"] == true) {
        switch ($_SESSION["userType"]) {
            case "admin":
                header("Location: ./admin.php");
                break;
            case "user":
                header("Location: ./index.php");
                break;
            default:
                header("Location: ./index.php?error=notLoggedIn");
                break;
        }
    }
}
?>
<!-- html code -->
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="../style/loginPage.css">
</head>

<body>
    <main>
    <!-- signup form -->
        <h1>Log In</h1>
        <div class="login">
            <form id="login" method="POST" action="../inc/login.inc.php">
                <label>UserName</label>
                <input type="text" name="username" id="username" placeholder="Username/E-mail" />
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Password" />
                <button type="submit" name="submit" id="log">Log In</button>
            </form>
            <!-- checks for errors -->
            <?php
            if (isset($_GET["error"])) {
                switch (($_GET["error"])) {
                    // checks if anything is empty
                    case "isEmpty":
                        echo '<p style="color : white ">Please fill in all the fields.</p>';
                        break;
                        // checks if user not found
                    case "userNotFound":
                        echo '<p style="color : white ">Username does not exists.</p>';
                        break;
                        // checks if password entered is incorrect
                    case "incorrectPassword":
                        echo '<p style="color : white ">Password does not match</p>';
                        break;
                    default:
                        echo '<p style="color : white ">Something went wrong...</p>';
                }
            }
            ?>
        </div>
</body>

</html>