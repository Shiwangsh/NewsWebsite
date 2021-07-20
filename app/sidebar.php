<?php
if (isset($_SESSION["userType"])) {
    if ($_SESSION["userType"] == "user") {
        header("Location: ../phpages/index.php");
    } else {
        echo '<nav>
        <ul>
            <li><a href="../phpages/create_article.php"><u>Create new article</u></a></li>
            <li><a href="../phpages/article_menu.php"><u>Manage Articles</u></a></li>
            <li><a href="../phpages/category_menu.php"><u>Manage categories</u></a></li>
            <li><a href="../inc/logout.inc.php">' . $text . '</a></li>
        </ul>
        </nav>';
    }
}
