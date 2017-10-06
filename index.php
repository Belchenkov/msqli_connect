<?php
  require_once 'config/config.php';
  require_once 'config/db.php';

  // Create Query
  $query = "SELECT * FROM `posts`";

  // Get Result
  $result = mysqli_query($conn, $query);

  // Fetch Data
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//  print_r($posts);
  // Free Result
  mysqli_free_result($result);

  // Close Connection
  mysqli_close($conn);

  include_once 'inc/header.php';
?>
  <h1 class="panel-heading text-center text-uppercase">Posts</h1>
  <div class="container">
    <?php foreach ($posts as $post) : ?>
      <div class="well">
        <h3><?= $post['title']; ?></h3>
        <small>Created on <?= $post['create_data']; ?></small>
        <p><?= $post['body']; ?></p>
        <div class="text-right">
          <a href="post.php?id=<?=$post['id']; ?>" class="btn btn-sm btn-info">Read More</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

<?php
include_once 'inc/footer.php';

