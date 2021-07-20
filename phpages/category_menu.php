<?php
require_once '../app/admin_check.in.php';
require_once '../DB/dbh.inc.php';
require_once '../functions/category_functions.inc.php';

// checks if id is provided to the url, if yes then sets category id as session.
if (isset($_GET["id"])) {
  $_SESSION["test_category_id"] = (int)$_GET["id"];
  $categoryArray = fetch_category_by_id($conn, $_GET["id"]);
}
?>
<?php include '../app/header.php' ?>
<main>
  <?php include '../app/sidebar.php' ?>
  <p>
    <?php
    if (isset($_GET["error"])) {
      switch ($_GET["error"]) {
        case "isEmpty":
          echo "Please enter a category to add";
          break;
        case "none":
          echo "Successfully created category";
          break;
        default:
          echo "Something went wrong!!";
      }
    }
    ?>
  </p>
  <!-- header and sidebar code ends here -->
  <table>
    <tr>
      <th>Category Name</th>
      <th>Edit/Delete</th>
    </tr>
    <?php
    $myArray = fetch_category($conn);
    for ($x = 0; $x < count($myArray); $x++) {
      echo '<tr>
        <td>' . $myArray[$x][1] . '</td>
        <td><a href="category.inc.php?edit=true&id=' . $myArray[$x][0] . '" class="category_button">Edit </a> /
          <a href="category.inc.php?delete=true&id=' . $myArray[$x][0] . '" class="category_button">Delete</a>
        </td>
      </tr>';
    }
    ?>
  </table>
  <!-- display category forms if the data is available vs when its not -->
  <div class="form">
    <?php
    if (isset($categoryArray)) {
      echo '    <form method="POST" action="../inc/category.inc.php">
    <label>Edit Category: </label><input type="text" class="input" name="category_name" value="' . $categoryArray[0][0] . '" /> 
    <input type="submit" name="edit_category" value="Update">
  </form>';
    } else {
      echo '<form method="POST" action="../inc/category.inc.php">
    <label>Add Category: </label><input type="text" class="input" name="category_name" value="" />
    <input type="submit" name="submit_category" value="Submit">
  </form>';
    }
    ?>
    <br>
  </div>
  </body>
</main>
<footer>
  &copy; Northampton News 2017
</footer>

</html>