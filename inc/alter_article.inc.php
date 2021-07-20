<?php
session_start();

require_once '../DB/dbh.inc.php';
require_once '../functions/articleFunctions.inc.php';
// checks if alter article button sent the POST request
if (isset($_POST["alter_article"])) {
    $title = $_POST["alter_title"];
    $subTitle = $_POST["alter_subtitle"];
    $content = $_POST["alter_content"];
    $category_id = $_POST["alter_category"];
    $timestamp = time();
    // if yes then update the article with the field provided
    update_article($conn, $_SESSION["editing_article_id"], $title, $subTitle, $content, $category_id, $timestamp);
} else {
    echo "Didn't alter article";
}
