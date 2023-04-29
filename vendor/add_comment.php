<?php
session_start();
require_once('../admin/server.php');

$username = mysqli_real_escape_string($db, $_SESSION['username']);
$sql = "SELECT id FROM users WHERE username='$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = $row['id'];
// Отримуємо параметри форми з POST-запиту
$news_id = $_GET['id'];
$content = $_POST['content'];





// Додаємо коментар до бази даних
$sql = "INSERT INTO comments (news_id, content, user_id) VALUES ('$news_id', '$content', '$user_id')";
if (mysqli_query($db, $sql)) {
  header("location: /news.php?id=$news_id");
} else {
  echo "Помилка: " . $sql . "<br>" . mysqli_error($db);
}

// Закриваємо з'єднання з базою даних
mysqli_close($db);
