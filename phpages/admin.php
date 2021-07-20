<?php
session_start();
if (isset($_SESSION["userType"])) {
    if ($_SESSION["userType"] == "admin") {
        $name =  $_SESSION["name"];
        $text = "Log Out";
    } else {
        header("Location: ../phpages/index.php?erorr=notAdmin");
    }
} else {
    header("Location: ../phpages/index.php?erorr=notAdmin");
}
require_once '../DB/dbh.inc.php';
require_once '../functions/articleFunctions.inc.php';

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../style/adminPage.css" />
    <title>Northampton News - Home</title>
</head>

<body>
    <!-- Includes the headeer from app/header.php and sidebar from app/sidebar.php -->

    <?php include '../app/header.php' ?>

    <main>
        <?php
        include '../app/sidebar.php'; ?>
        <!-- show articles from database -->
        <?php
        $newArray = fetch_all_articles($conn);
        if (isset($newArray)) {
            if ($newArray == false) {
                echo "<p>There are no articles in database</p>";
            } else {
                for ($x = 0; $x < count($newArray); $x++) {
                    echo '<article>
		            <br>
		            <a href="article.php?article_id=' . $newArray[$x][0] . '</" class="heading">
		                <h2>' . $newArray[$x][1] . '</h2>
					</a>
					<h4>' . $newArray[$x][2] . '</h4>
		            <p>' . $newArray[$x][3] . '</p>
		        </article>';
                }
            }
        }
        ?>
    </main>

    <footer>
        &copy; Northampton News 2017
    </footer>

</body>

</html>