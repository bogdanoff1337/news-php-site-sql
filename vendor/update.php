<?php
// Підключення до бази даних
require_once('../admin/server.php');

// Отримання даних з форми
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

// Оновлення даних в базі даних
$sql = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
mysqli_query($db, $sql);

// Повернення на сторінку новини
header("Location: /news.php?id=$id");
