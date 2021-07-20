<?php
session_start();
require_once '../functions/comment_functions.php';
require_once '../DB/dbh.inc.php';
// if user is logged in then can comment
if (isset($_SESSION["loggedIn"])) {
    if (isset($_SESSION["comment_article_id"])) {
        $timestamp = time();
        create_comment($conn, $_SESSION["comment_article_id"], $_POST["comment_area"], $timestamp);
    }
} else {
    // if not then sent back to location of the article itself
    if (isset($_SESSION["comment_article_id"])) {
        header('location: ../phpages/article.php?article_id=' . $_SESSION["comment_article_id"] . '&error=notLoggedIn');
    }
}
