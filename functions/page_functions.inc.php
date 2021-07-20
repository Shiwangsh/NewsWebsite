<?php
// gets author name from id where article_id = $article_author_id
function get_author_by_id($conn, $article_author_id)
{
    $sql = "SELECT name FROM users WHERE userID=?";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/home.php?error=fetchAuthorFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'i', $article_author_id);
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
