<?php
require_once('server.php');
if (isset($_SESSION['reg_user']) || $_SESSION['reg_user'] == true) {
  // якщо користувач не залогінений, перенаправити його на сторінку входу
  header('Location: login.php');
  exit;
} else {
  header('Location: add-news.php');
}
