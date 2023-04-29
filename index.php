<?php
include "header.php";
?>

<body>
  <div class="container">
    <div class="row">
      <?php
      $news = mysqli_query($db, "SELECT * FROM news ORDER BY id DESC");

      while ($row = mysqli_fetch_assoc($news)) {
        $title = $row['title'];
        $id = $row['id'];
        $created_at = $row['created_at'];
      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="card-body">
              <h4><?php echo substr($row['title'], 0, 20); ?>...</h4>
              <p class="card-text"><?php echo substr($row['content'], 0, 20); ?>...</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="news.php?id=<?php echo $id; ?>">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  </a>
                </div>
                <small class="text-body-secondary"><?php echo $created_at; ?></small>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h4>Add News</h4>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <?php
                if (isset($_SESSION['username'])) {
                ?>
                  <a href="add-news.php">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Add News</button>
                  </a>
                <?php
                } else {
                ?>
                  <a href="./admin/login.php">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Login to Add News</button>
                  </a>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>