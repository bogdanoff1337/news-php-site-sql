<?php
session_start();
function createNews($title, $content)
{
  require_once('./admin/server.php');

  $username = mysqli_real_escape_string($db, $_SESSION['username']);
  $sql = "SELECT id FROM users WHERE username='$username'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];



  if (!isset($_SESSION['username'])) {
    header("Location: ./admin/login.php");
    exit;
  }

  // Отримати дані форми додавання новини
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $content = mysqli_real_escape_string($db, $_POST['content']);


  // Запит на додавання нової новини до таблиці news
  $sql = "INSERT INTO news (title, content, user_id) VALUES ('$title', '$content', '$user_id')";

  if (mysqli_query($db, $sql)) {
    header('location: index.php');
  }

  // Закрити з'єднання з БД, якщо воно більше не потрібне
  mysqli_close($db);
}
