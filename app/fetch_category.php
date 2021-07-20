<?php
$newArray = fetch_category($conn);
for ($x = 0; $x < count($newArray); $x++) {
    echo '<option value=' . $newArray[$x][0] . '>' . $newArray[$x][1] . '</option>';
}
