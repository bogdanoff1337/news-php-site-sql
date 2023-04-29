<?php
// Підключення до бази даних
require_once('../admin/server.php');


$news_id = $_GET['id'];

$del_comments = "DELETE FROM comments WHERE news_id = $news_id";
mysqli_query($db, $del_comments);

$del = "DELETE FROM `news` WHERE `id` = $news_id";

if (mysqli_query($db, $del)) {
  header('location: /index.php');
}
