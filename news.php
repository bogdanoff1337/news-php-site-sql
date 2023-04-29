<?php
include('header.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>News</title>
  <link rel="stylesheet" type="text/css" href="/css/news.css">
</head>

<body>
  <div class="conteiner_card">


    <?php
    // Підключення до бази даних та виконання запиту для отримання даних
    $news_id = $_GET['id'];
    // ID запису, який треба вивести
    $sql = "SELECT news.*, users.username, users.is_admin FROM news JOIN users ON news.user_id = users.id WHERE news.id = $news_id";
    $news = mysqli_query($db, $sql);
    // Перевірте, чи є запис про новину
    if (mysqli_num_rows($news) == 0) {
      // Якщо запису про новину не знайдено, виведіть повідомлення про помилку
      echo "Новину не знайдено.";
    } else { // Якщо запис про новину знайдено, виведіть інформацію про неї
      $row = mysqli_fetch_assoc($news);
      $user_id = $_GET['id'];


    ?>

      <p><?php echo $row['title']; ?></p>
      <p><?php echo $row['content']; ?></p>
      <small class="text-body-secondary"><?php echo $row['created_at']; ?></small>
      <small class="text-body-secondary"><?php echo "create by " .  $row['username']; ?></small>
      <div class="btn-group">

        <?php

        // Перевірка, чи поточний користувач є автором новини
        if ($row['username'] == $_SESSION['username']) {
        ?>


          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <a href="vendor/delete.php?id=<?php echo $row['id'] ?>">
            <span type="submit" class="btn btn-outline-secondary" name="delete">Delete</span></a>


          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <a href="news_update_form.php?id=<?php echo $row['id'] ?>">
            <span type="submit" class="btn  btn-outline-secondary" name="update">Update</span></a>

      </div>
  </div>

<?php
        }
      }
?>

<?php
// Підключення до бази даних та виконання запиту для отримання коментарів

$comment = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.news_id = $news_id ORDER BY comments.created_at DESC";
$comments = mysqli_query($db, $comment);
$current_user_id = $_SESSION['username'];
?>

<?php
// Перевіряємо, чи була надіслана форма для оновлення коментаря
if (isset($_POST['update_comment'])) {
  $new_comment = $_POST['new_comment'];
  $comment_id = $_POST['comment_id'];

  // Виконуємо запит на оновлення коментаря в базі даних
  $update_query = "UPDATE comments SET content='$new_comment' WHERE comment_id=$comment_id";
  mysqli_query($db, $update_query);

  // Перенаправляємо користувача на сторінку з новиною, щоб побачити оновлений коментар
  header("Location: /news.php?id=$news_id");
  exit();
}
?>

<?php
if (isset($_POST['delete'])) {
  $comment_id = $_POST['comment_id'];
  $delete_query = "DELETE FROM comments WHERE comment_id = $comment_id";
  mysqli_query($db, $delete_query);
  // Оновіть поточну сторінку, щоб відобразити оновлений список коментарів
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
}
// Виведення списку коментарів
if (mysqli_num_rows($comments) > 0) {
  while ($comment = mysqli_fetch_assoc($comments)) {
    $comment_id = $comment['comment_id'];
    $is_author = ($comment['username'] == $current_user_id);
    $is_editing = false;

    if (isset($_POST['edit_comment']) && $_POST['comment_id'] == $comment_id) {
      $is_editing = true;
    }

?>
    <div class="container_comment">
      <div class="comment">
        <h5><?php echo "Username: " . $comment['username']; ?></h5>
        <?php if (!$is_editing) : ?>
          <p><?php echo  $comment['content']; ?></p>
          <small class="text-body-secondary"><?php echo "Data : " . $comment['created_at']; ?></small>
          <?php if ($is_author) : ?>
            <form method="post">
              <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
              <button type="submit" name="edit_comment">Edit</button>
              <button type="submit" name="delete">Delete</button>
            </form>
          <?php endif; ?>
        <?php else : ?>
          <form method="POST" action="">
            <textarea name="new_comment"><?php echo $comment['content']; ?></textarea>
            <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
            <button type="submit" name="update_comment">Update</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
<?php
  }
} else {
  echo "<p>Коментарів немає</p>";
}
?>

<?php
// Додавання форми для додавання коментаря
if (isset($_SESSION['username'])) {
?>
  <div class="container_add">

    <div class="comment">

      <h5 class="">Додати коментар</h5>
      <form action="vendor/add_comment.php?id=<?php echo $row['id'] ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="form-group">
          <textarea class="card-text-coment" name="content" rows="3" maxlength="67"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Додати</button>
      </form>

    </div>

  </div>

<?php
}
?>

</body>