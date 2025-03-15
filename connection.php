<?php

$connect = mysqli_connect('localhost', 'root', '', 'movies');

if (!$connect) {
  echo 'Error Code: ' . mysqli_connect_errno();
  echo 'Error Message: ' . mysqli_connect_error();
  exit;
}

?>
