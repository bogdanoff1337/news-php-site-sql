<?php
session_start();
require_once('./vendor/create.php');
if (isset($_POST['title']) && isset($_POST['content'])) {
  // create the news item
  createNews($_POST['title'], $_POST['content']);
  // redirect to homepage
  header("Location: /index.php");
  exit();
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>News add</title>
  <link rel="stylesheet" type="text/css" href="/css/news.css">
</head>

<body>
  <form method="post">
    <div class="conteiner_card">



      <input type="text" class="card-title" name="title" id="" maxlength="200" placeholder="Write the title"></input>
      <textarea class="card-text" name="content" id="" rows="3" maxlength="500" placeholder="what's happening?"></textarea>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">

          <button type="submit" class="btn btn-sm btn-outline-secondary">Upload</button>
        </div>
        <small class="text-body-secondary"></small>
      </div>


    </div>
  </form>
</body>

</html>