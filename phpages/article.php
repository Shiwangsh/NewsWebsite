<?php
session_start();
require_once '../DB/dbh.inc.php';
require_once '../functions/page_functions.inc.php';
require_once '../functions/articleFunctions.inc.php';
require_once '../functions/comment_functions.php';

// error checking

if (isset($_GET["error"])) {
  switch ($_GET["error"]) {
    case "notLoggedIn":
      $login_error = "Please Login to comment";
      break;
    default:
      $login_error = '';
  }
} else {
  $login_error = '';
}

?>
<!-- HTML code -->
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../style/style.css" />
  <title>Northampton News - Home</title>
</head>
<!-- includes set header from app folder -->
<?php include '../app/header.php'; ?>
<main>
<!-- includes set sidebar from app folder -->

  <?php include '../app/sidebar.php'; ?>
  <?php
  $newArray = fetch_single_article($conn, $_GET["article_id"]);
// the function above fetches a single article by its article_id
  if (isset($newArray)) {
    // if the array has no data
    if ($newArray == false) {
      echo "<p>There are no articles in database</p>";
    // if the array has data
    } else {
      $_SESSION["comment_article_id"] = $newArray[0][0];
      $title = $newArray[0][1];
      $subttitle = $newArray[0][2];
      $content = $newArray[0][3];
      echo     '<article>
									<h2>' . $title . '</h2>
								<h4>' .  $subttitle . '</h4>
								<p>' . $content . '</p>
                            </article>
                            <form action="../inc/comment.inc.php" method="POST"><p>
                            ' . $login_error . '</p>
                            <textArea class="commentBox" name="comment_area"></textArea>
                            <input type="submit" name="comment" value="Comment" />
                        </form> <br><div class="showComment">';
// check if comment article is set, if not then it shows no comments here or else show this block 
      if (isset($_SESSION["comment_article_id"])) {
        if (fetch_all_comments($conn, $_SESSION["comment_article_id"])) {
          $comment_array = fetch_all_comments($conn, $_SESSION["comment_article_id"]);
          for ($x = 0; $x < count($comment_array); $x++) {
            echo '<p>' . $comment_array[$x][1] . '</p>';
          }
        } else {
          echo "<p> No Comments here</p>";
        }
      }
    }
  }
  echo '</div>'
  ?>
</main>

<footer>&copy; Northampton News 2017</footer>
</body>

</html>