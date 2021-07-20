<?php
echo '<article>
<h2>Articles</h2>
<table>
  <thead>
    <tr class="align-left">
      <th>Title</th>
      <th>Category</th>
      <th>Author</th>
      <th>Edit/Delete</th>
    </tr>
  </thead>
  <tbody>
    <!-- Subtitle -->
    <tr>
      <td>
        <!-- title -->
      </td>
      <td>
        <!-- category here -->
      </td>
      <td>
        <!-- author name -->
      </td>
      <td><a href="alter_article.php" class="article_alter_button">Edit</a> /
        <a href="../functions/delete_article_functions.inc.php" class="article_delete_button">Delete</a>
    </tr>
  </tbody>
</table>
</article>';
