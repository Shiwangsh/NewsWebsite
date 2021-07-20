<?php
session_start();
// requiring all the files that we are going to use 
require_once '../DB/dbh.inc.php';
require_once '../functions/category_functions.inc.php';
require_once '../functions/articleFunctions.inc.php';
if (isset($_GET["article_id"])) {
    $article_id = (int)$_GET["article_id"];
    $sql = "DELETE FROM articles WHERE article_id = ?;";
    // $sql2 = "SELECT article_id FROM articles WHERE "
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/article_menu.php?error=createArticleFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'i', $article_id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../phpages/article_menu.php?deleted=1");
    exit();
} else {
    header("Location ../phpages/article_menu.php?error=noArticleIdSent");
}
