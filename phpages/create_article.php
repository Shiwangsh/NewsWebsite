<?php
require_once '../app/admin_check.in.php';
require_once '../DB/dbh.inc.php';
require_once '../functions/category_functions.inc.php';

?>
<?php include '../app/header.php' ?>
<!-- display the create article form that can submit to the datbase after POST -->
<main>
    <?php include '../app/sidebar.php' ?>
    <form action="../inc/create_article.inc.php" method="POST">
        <p> <?php
        // checking for errors
            if (isset($_GET["error"])) {
                switch ($_GET["error"]) {
                    case "isEmpty":
                        echo "Please fill in all the fields";
                        break;
                    case "none":
                        echo "Article Successfully submitted";
                        break;
                    default:
                        echo "Something went wrong";
                }
            } else {
                echo "Create a new article: ";
            }
            ?></p>

        <label>Article title</label> <input type="text" name="title" />
        <label>Article sub-title</label> <input type="text" name="sub-title" />
        <label>Content</label> <textarea name="content"></textarea>
<!-- display categories from database in an option select menu -->
        <label for="select_category">Select a category</label>
        <select name="category_option" id="category">
            <option value="0">Select a category</option>
            <?php include '../app/fetch_category.php' ?>
        </select>
        <input type="submit" name="submit_article" value="Submit" />
    </form>
    </article>
</main>
<footer>
    &copy; Northampton News 2017
</footer>

</body>

</html>