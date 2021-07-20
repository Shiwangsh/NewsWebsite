<?php
session_start();
if (isset($_POST["submit_article"])) {
    $title = $_POST["title"];
    $subTitle = $_POST["sub-title"];
    $content = $_POST["content"];
    $userID = $_SESSION["userID"];
    $category_id = $_POST["category_option"];
    $timestamp = time();

    require_once '../DB/dbh.inc.php';
    require_once '../functions/articleFunctions.inc.php';
// checks if the article fields are empty
    if (isEmpty($title, $subTitle, $content, $category_id) !== false) {
        header('location: ../phpages/create_article.php?error=isEmpty');
        exit();
    }
    // if not creates article
    createArticle($conn, $title, $subTitle, $content, $userID, $category_id, $timestamp);
} else {
    echo "Didn't submit article";
}
