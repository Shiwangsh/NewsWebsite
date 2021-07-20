<?php
session_start();
// checks usertype if logged in or redirects as error to Home
if (isset($_SESSION["loggedIn"])) {
  if ($_SESSION["userType"] == "admin") {
    $name =  $_SESSION["name"];
    $text = "Log Out";
  } else {
    header("Location: ../phpages/index.php?erorr=notAdmin");
  }
} else {
  header("Location: ../phpages/index.php?erorr=notAdmin");
}
require_once '../DB/dbh.inc.php';
require_once '../functions/articleFunctions.inc.php';

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../style/alter_articles.css" />
  <title>Northampton News - Home</title>
</head>

<body>
  <?php
  include '../app/header.php';
  ?>
  <main>
    <?php
    include '../app/sidebar.php';
    ?>

    <article>
      <h2>Articles</h2>
      <!-- not admin -->
      <!-- noArticleSelected -->
      <!-- createArticleFailed -->
      <!-- none -->
      <table>
        <thead>
          <tr class="align-left">
            <th>Title</th>
            <th>Category</th>
            <th>Manage</th>
          </tr>
        </thead>
        <?php
        // checks if the user is logged n by checkin userID in session variable
        // echo $_SESSION["userID"];
        if (isset($_SESSION["userID"])) {
          $myArray = fetch_articles_as_admin($conn, $_SESSION["userID"]);
          if (isset($myArray)) {
            // array either returns bool false or with data, so false check first
            if ($myArray == false) {
              echo "<p>You dont have any articles</p>";
            } else {
              for ($x = 0; $x < count($myArray); $x++) {
                echo '<tbody>
          <!-- Subtitle -->
          <tr>
            <td>
              ' . $myArray[$x][1] . '
            </td>
            <td>
            ' . $myArray[$x][5] . '
            </td>
            <td><a href="alter_article.php?article_id=' . $myArray[$x][0] . '" class="article_alter_button">Edit / </a>
              <a href="../functions/delete_article_functions.inc.php?article_id= ' . $myArray[$x][0] . '" class="article_delete_button">Delete</a>
            </td>
            </td>
          </tr>
        </tbody>';
              }
            }
          }
        } else {
          header("Location: ./home.php");
        }
        ?>

      </table>
    </article>
  </main>
  <footer>&copy; Northampton News 2017</footer>
</body>

</html>