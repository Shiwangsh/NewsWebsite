<?php
// starting the session to store session variables
session_start();
// check if user is logged in using session variable
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
        header("Location: ./index.php?error=generic");
        break;
    }
  }
}
?>
<!-- signup form submits data to DB -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style/signupPage.css" />
  <title>Sign up</title>
</head>

<body>
  <h1>Register</h1>
  <div class="Register">
    <form class="signup" method="POST" action="../inc/signup.inc.php">
      <label for="name">Name</label>
      <input type="text" name="name" />
      <label for="username">Username</label>
      <input type="text" name="username" />
      <label for="email">Email</label>
      <input type="text" name="email" />
      <label for="password">Password</label>
      <input type="password" name="password" />
      <label for="confirm_password">Confirm Password</label>
      <input type="password" name="confirm_password" />
      <button type="submit" name="register_btn">Submit</button>
    </form>
    <!-- Signup validation for new user signup -->
    <?php
    if (isset($_GET["error"])) {
      switch (($_GET["error"])) {
        // checks if any box is empty
        case "isEmpty":
          echo '<p style="color : white " >Please fill in all the fields.</p>';
          break;
        // checks if user is invalid
        case "invalidUser":
          echo '<p style="color : white " >Username should be only letters and numbers.</p>';
          break;
        // checks if email is invalid using built int regex
        case "invalidEmail":
          echo '<p style="color : white " >Please enter a valid E-mail. <br><em>for e.g</em> JaneDoe@example.com</p>';
          break;
          // checks is password invalid
        case "invalidPassword":
          echo '<p style="color : white " >Passwords do not match. Please try again.</p>';
          break;
          // checks if user already exists
        case "userAlreadyExists":
          echo '<p style="color : white " >Username already exists.</p>';
          break;
          // if no errors, log user in
        case "none":
          echo '<p style="color : white " >Successfully signed up. <br><a href="login.php">Login</a> to continue...</p>';
          break;
        default:
          echo '<p style="color : white " >Something went wrong...</p>';
      }
    }
    ?>
  </div>
</body>

</html>