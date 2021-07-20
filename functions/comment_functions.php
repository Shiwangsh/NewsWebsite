<?php
// creates a comment
function create_comment($conn, $article_id, $comment, $timetsamp)
{
    $sql = "INSERT INTO comments(comment_value,author_id,article_id,comment_time) VALUES(?,(SELECT userID FROM articles WHERE article_id=?),?,?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/create_page.php?article_id=' . $article_id . '&error=createCommentFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'siii', $comment, $article_id, $article_id, $timetsamp);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header('location: ../phpages/article.php?article_id=' . $article_id . '&error=none');
    exit();
}
// fetches all the comments by article id
function fetch_all_comments($conn, $article_id)
{
    $sql = "SELECT * FROM comments WHERE article_id = ? ORDER BY comment_time;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/home.php?error=fetchFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'i', $article_id);
    mysqli_stmt_execute($statement);
    $resultData = mysqli_stmt_get_result($statement);
    if ($row = mysqli_fetch_all($resultData, MYSQLI_NUM)) {
        return $row;
    } else {
        $result = false;
    }
    mysqli_stmt_close($statement);
    return $result;
}
