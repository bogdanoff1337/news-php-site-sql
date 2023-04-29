<?php
include('header.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>News</title>
  <link rel="stylesheet" type="text/css" href="/css/news.css">
</head>
<?php
$news_id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $news_id";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Update news</title>
  <link rel="stylesheet" type="text/css" href="/css/news.css">
</head>

<body>
  <div class="conteiner_card">


    <form action="vendor/update.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <input type="text" class="card-title" name="title" value="<?php echo $row['title']; ?>">


      <textarea type="text" class="card_text" name="content" value=""><?php echo $row['content']; ?></textarea>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>


  </div>
</body>

</html>