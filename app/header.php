<?php
// session_start();
include_once '../DB/dbh.inc.php';
include_once '../functions/category_functions.inc.php';
echo ' <!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../style/create_article.css" />
    <title>Northampton News - Home</title>
</head>

<body>
   <header>
<section>
    <h1>Northampton News</h1>
</section>
</header> 
<nav>
<ul>
<li><a href="../phpages/index.php">Home</a></li>
            <li><a href="#">Select Category</a>
            <ul>';
$myArray = fetch_category($conn);
for ($x = 0; $x < count($myArray); $x++) {
    echo '<li><a href="../phpages/index.php?category=' . $myArray[$x][1] . '">' . $myArray[$x][1] . '</a></li><br>';
}
echo '</ul>
            </li>';
if (isset($_SESSION["loggedIn"])) {
    if (isset($_SESSION["userType"])) {
        if ($_SESSION["userType"] == "admin") {
            $text = "Log Out";
            echo '<li><a href="admin.php">' . $_SESSION["name"] . '</a></li>';
            echo '<li><a href="../inc/logout.inc.php">' . $text . '</a></li>';
        } else if ($_SESSION["userType"] == "user") {
            $text = "Log Out";
            echo '<li><a href="#">' . $_SESSION["name"] . '</a></li>';
            echo '<li><a href="../inc/logout.inc.php">' . $text . '</a></li>';
        }
    }
} else {
    echo '<li><a href="../phpages/login.php">Login</a></li>
    <li><a href="../phpages/signup.php">Sign Up</a></li>
        
    ';
}
echo '</ul>
</nav>
<img src="../images/banners/randombanner.php" />';
