<?php
$mysqli = new mysqli("sql11.freesqldatabase.com","sql11677398","jGVphLaFgW", "sql11677398");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>