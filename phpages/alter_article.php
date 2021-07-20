<?php
require_once '../app/admin_check.in.php';
require_once '../DB/dbh.inc.php';
require_once '../functions/category_functions.inc.php';
require_once '../functions/articleFunctions.inc.php';
// check if the url has the article id 
if (isset($_GET["article_id"])) {
    $_SESSION["editing_article"] = (int)$_GET["article_id"];
    // if it does then  stores the id in session vairable
}

// if the session for editing article starts
if (isset($_SESSION["editing_article"])) {

    if (!$_SESSION["editing_article"] == false) {
        $article_array = fetch_article_by_id($conn, $_SESSION["editing_article"])[0];
        $category_name = fetch_article_by_id($conn, $_SESSION["editing_article"])[1];
        $_SESSION["editing_article_id"] = $article_array[0][0];
        $_SESSION["editing_article_category"] = $article_array[0][5];
    } else {
        header("Location article_menu.php?error=noArticleSelected");
    }
} else {
    echo "Error";
}

?>

<?php include '../app/header.php' ?>

<main>
    <?php include '../app/sidebar.php' ?>


<!-- display the alter article form -->
    <form action="../inc/alter_article.inc.php" method="POST">
        <p> <?php
            if (isset($_GET["error"])) {
                switch ($_GET["error"]) {
                    case "none":
                        echo "Article Successfully Updated";
                        break;
                    default:
                        echo "Something went wrong";
                }
            } else {
                echo "Update an article: ";
            }
            ?></p>
<!-- display article -->
        <label>Change title</label> <input type="text" name="alter_title" value="<?php echo $article_array[0][1]; ?>" />
        <label>Change sub-title</label> <input type="text" name="alter_subtitle" value="<?php echo $article_array[0][2]; ?>" />
        <label>Change Content</label> <textarea name="alter_content"><?php echo $article_array[0][3]; ?></textarea>
        <label for="select_category">Change Category</label>

        <select name="alter_category" id="category" value="<?php echo $article_array[0][5]; ?>">
            <option value="0"><?php echo $category_name[0][0]; ?></option>
            <?php include '../app/fetch_category.php' ?>
        </select>

        <input type="submit" name="alter_article" value="Update" />
    </form>
    </article>
</main>

<footer>
    &copy; Northampton News 2017
</footer>

</body>

</html>