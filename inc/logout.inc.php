<?php
// code for loggin out, destsroys the session and unsets any set variables then redirects to index.php
session_start();
session_unset();
session_destroy();
header("Location: ../phpages/index.php");
