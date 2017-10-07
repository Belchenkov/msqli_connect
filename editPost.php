<?php
  require_once 'config/config.php';
  require_once 'config/db.php';

  // Check for Submit
  if (isset($_POST['submit'])) {
    // Get form data
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "UPDATE `posts` SET `title`='$title', `body`='$body' WHERE `id`=" . $update_id;

    if (mysqli_query($conn, $query)) {
      header('Location: post.php?id=' . $update_id);
    } else {
      echo 'ERROR: ' . mysqli_error($conn);
    }
  }

  // Get ID
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  // Create Query
  $query = "SELECT * FROM `posts` WHERE `id`=$id";

  // Get Result
  $result = mysqli_query($conn, $query);

  // Fetch Data
  $post = mysqli_fetch_assoc($result);
  //  print_r($posts);
  // Free Result
  mysqli_free_result($result);

  // Close Connection
  mysqli_close($conn);

  include_once 'inc/header.php';
?>
  <h1 class="panel-heading text-center text-uppercase">Edit Post</h1>
  <div class="container">
    <div class="col-md-8 col-md-offset-2">
      <a href="index.php" class="btn btn-primary btn-sm">Back</a>
      <br><br>
      <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" value="<?= $post['title']; ?>" id="title" class="form-control" />
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea name="body" id="body" class="form-control"><?= $post['body']; ?>
          </textarea>
          <input type="hidden" name="update_id" value="<?=$post['id']; ?>">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Update Post" class="btn btn-primary btn-sm" />
        </div>
      </form>
    </div>
  </div>

<?php
include_once 'inc/footer.php';

