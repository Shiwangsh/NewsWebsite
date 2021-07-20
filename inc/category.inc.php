<?php
session_start();
require_once '../DB/dbh.inc.php';
require_once '../functions/category_functions.inc.php';
// if submit category button sends a POST request
if (isset($_POST["submit_category"])) {
    $category_name = $_POST["category_name"];
    if (isCategoryEmpty($category_name) !== false) {
        header('location: ../phpages/category_menu.php?error=isEmpty');
        exit();
    }
    // if category not empty
    create_category($conn, $category_name);
} else if (isset($_GET["delete"])) {
    if ($_GET["delete"] == true) {
// if delete category button sends a POST request
header("Location: ../phpages/category_menu?deleted=true");
    }
} else if (isset($_GET["edit"])) {
    if ($_GET["edit"] == true) {
        $category_name = $_POST["category_name"];
        if (isCategoryEmpty($category_name) !== false) {
            header('location: ../phpages/category_menu.php?error=isEmpty');
            exit();
        }
        header("Location: ../phpages/admin.php");
        edit_category($conn, $category_name, $category_id);
        header("Location: ../phpages/category_menu?deleted=true");
    }
}
