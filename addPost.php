<?php
  require_once 'config/config.php';
  require_once 'config/db.php';

  // Check for Submit
  if (isset($_POST['submit'])) {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "INSERT INTO `posts`(`title`, `body`) VALUES('$title', '$body')";

    if (mysqli_query($conn, $query)) {
      header('Location: index.php');
    } else {
      echo 'ERROR: ' .mysqli_error($conn);
    }
  }

  include_once 'inc/header.php';
?>
  <h1 class="panel-heading text-center text-uppercase">Add Post</h1>
  <div class="container">
    <div class="col-md-8 col-md-offset-2">
      <a href="index.php" class="btn btn-primary btn-sm">Back</a>
      <br><br>
      <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control" />
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea name="body" id="body" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Add Post" class="btn btn-primary btn-sm" />
        </div>
      </form>
    </div>
  </div>

<?php
include_once 'inc/footer.php';

