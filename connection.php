<?php

$connect = mysqli_connect('127.0.0.1', 'root', '', 'movies', 3309);

if (!$connect) {
  echo 'Error Code: ' . mysqli_connect_errno();
  echo 'Error Message: ' . mysqli_connect_error();
  exit;
}

?>
