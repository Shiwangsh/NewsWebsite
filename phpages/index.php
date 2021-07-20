<?php
// checks if the url returning here sends a category, if not then it sets category to default
session_start();
require_once '../functions/articleFunctions.inc.php';
require_once '../DB/dbh.inc.php';
if (isset($_GET["category"])) {
	$category = $_GET["category"];
} else {
	$category = "default";
}

?>
<!-- html code -->
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="../style/style.css" />
	<title>Northampton News - Home</title>
</head>

<body>
	<?php include '../app/header.php' ?>
<!-- display articles by -->
	<main>

		<!-- show articles from database -->
		<?php
		$newArray = fetch_articles_by_category($conn, $category);
		if (isset($newArray)) {
			if ($newArray == false) {
				echo "<p>There are no articles in database</p>";
			} else {
				for ($x = 0; $x < count($newArray); $x++) {
					echo 	'<article>
								<br>
								<a href="article.php?article_id=' . $newArray[$x][0] . '" class="heading">
									<h2>' . $newArray[$x][1] . '</h2>
								</a>
								<h4>' . $newArray[$x][2] . '</h4>
								<p>' . $newArray[$x][3] . '</p>
							</article>';
				}
			}
		}
		?>
	</main>
	<?php
	?>
	<footer>
		&copy; Northampton News 2017
	</footer>

</body>

</html>