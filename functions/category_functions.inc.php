<?php
function create_category($conn, $category_name)
{
    $sql = "INSERT INTO categories(category_name) VALUES(?);";
    // $sql2 = "SELECT article_id FROM articles WHERE "
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/create_category.php?error=createFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 's', $category_name);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../phpages/category_menu.php?error=none");
    exit();
}
function fetch_category($conn)
{
    $sql = "SELECT * FROM categories;";
    // $result = mysqli_fetch_all(mysqli_query($conn, $sql, MYSQLI_ASSOC));
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/create_category.php?error=fetchFailed');
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
function isCategoryEmpty($category_name)
{
    $result = false;
    if (empty($category_name)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function edit_category($conn, $category_name, $category_id)
{
    $sql = "UPDATE categories SET category_name = ? WHERE category_id=? ;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/category_menu.php?error=alterArticleFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'si', $category_name, $category_id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header('location: ../phpages/category_menu.php?error=none');
    exit();
}
function fetch_category_by_id($conn, $id)
{
    $sql = "SELECT category_name FROM categories where category_id = ?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header('location: ../phpages/create_category.php?error=fetchFailed');
        exit();
    }
    mysqli_stmt_bind_param($statement, 'i', $id);
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
