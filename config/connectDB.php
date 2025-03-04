<?php
  define("HOST", "127.0.0.1");
  define("USER", "root");
  define("PWD", "");
  define("DB", "ecommerce");

  $conn = mysqli_connect(HOST, USER, PWD, DB);
  if(!$conn) {
    die("Connection error!");
  }
?>