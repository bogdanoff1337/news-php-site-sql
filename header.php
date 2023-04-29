<?php
ob_start();
session_start();
require_once('./admin/server.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css">

  <title>News</title>
</head>

<body>
  <div class="container_nav">
    <div class="nav-left">
      <a href="index.php">
        <h1>News</h1>
      </a>

    </div>
    <div class="nav-right">
      <?php
      if (isset($_SESSION['username'])) {
        echo '<form method="post" action="./admin/logout.php">
                <button id="auth-btn" class="btn_reg" type="submit" name="logout">Logout</button>
              </form>';
      } else {
        echo '<form method="post" action="./admin/login.php">
                <button id="auth-btn" class="btn_reg" type="submit" name="login">Login</button>
              </form>';
      }
      ?>
    </div>
  </div>

</body>

</html>