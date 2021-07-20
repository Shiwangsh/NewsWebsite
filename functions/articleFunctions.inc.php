<?php

function isEmpty($title, $subTitle, $content, $category_id)
{
    $result = false;
    if (empty($title) || empty($subTitle) || empty($content) || ($category_id == 0)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function createArticle($conn, $title, $subTitle, $content, $userID, $category_id, $timestamp)
{

    $sql = "INSERT INTO articles(article_title,article_subtitle,article_content,userID,category_id,post_date) VALUES(?,?,?,?,?,?);";
    // $sql2 = "SELECT article_id FROM articles WHERE "
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/create_article.php?error=createArticleFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'sssiii', $title, $subTitle, $content, $userID, $category_id, $timestamp);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../phpages/create_article.php?error=none");
    exit();
}
function fetch_articles_as_admin($conn, $userID)
{
    $sql = "SELECT * FROM articles WHERE userID = ?;";
    // $result = mysqli_fetch_all(mysqli_query($conn, $sql, MYSQLI_ASSOC));
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/admin.php?error=fetchFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'i', $userID);
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
function fetch_all_articles($conn)
{
    $sql = "SELECT * FROM articles ORDER BY post_date DESC;";
    // $result = mysqli_fetch_all(mysqli_query($conn, $sql, MYSQLI_ASSOC));
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/home.php?error=fetchFailed');
        exit();
    }
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
function fetch_article_by_id($conn, $article_id)
{
    $sql = "SELECT * FROM articles WHERE article_id = ?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/admin.php?error=fetchFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'i', $article_id);
    mysqli_stmt_execute($statement);
    $resultData = mysqli_stmt_get_result($statement);
    if ($category_row = mysqli_fetch_all($resultData, MYSQLI_NUM)) {
        $sql2 = "SELECT category_name from categories WHERE category_id = ?;";
        $statement2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement2, $sql2)) {
            header('location: ../phpages/admin.php?error=fetchFailed');
            exit();
        }
        mysqli_stmt_bind_param($statement2, 'i', $category_row[0][5]);
        mysqli_stmt_execute($statement2);
        $resultData2 = mysqli_stmt_get_result($statement2);

        if ($row2 = mysqli_fetch_all($resultData2, MYSQLI_NUM)) {
            return [$category_row, $row2];
        } else {
            $result = false;
        }
        return $category_row;
    } else {
        $result = false;
    }
    mysqli_stmt_close($statement);
    return $result;
}
function fetch_articles_by_category($conn, $category)
{
    if ($category === "default") {
        $sql = "SELECT * FROM articles ORDER BY post_date DESC;";
    } else {
        $sql = "SELECT * FROM articles WHERE category_id=(SELECT category_id FROM categories WHERE category_name=?) ORDER BY post_date DESC;";
    }
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/home.php?error=categoryArticleFetchFailed');
        exit();
    }
    if ($category !== "default") {
        mysqli_stmt_bind_param($statement, 's', $category);
    }
    mysqli_stmt_execute($statement);
    $resultData = mysqli_stmt_get_result($statement);
    if ($row = mysqli_fetch_all($resultData, MYSQLI_NUM)) {
        return $row;
    } else {
        $result = false;
    }
    mysqli_stmt_close($statement);
    return $result; {
    }
}
function update_article($conn, $article_id, $title, $subTitle, $content, $category_id, $timestamp)
{
    $sql = "UPDATE articles SET article_title = ?,article_subtitle = ?,article_content = ?,category_id = ?,post_date= ? WHERE article_id = ?;";
    // $sql2 = "SELECT article_id FROM articles WHERE "
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/alter_article.php?error=alterArticleFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'sssiii', $title, $subTitle, $content, $category_id, $timestamp, $article_id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header('location: ../phpages/alter_article.php?error=none&title=' . $title . '&article_id=' . $article_id . 'category_id=' . $category_id);
    exit();
}
function fetch_single_article($conn, $article_id)
{
    $sql = "SELECT * FROM articles WHERE article_id = ?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/admin.php?error=fetchFailed');
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
