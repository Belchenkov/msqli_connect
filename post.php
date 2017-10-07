<?php
require_once 'config/config.php';
require_once 'config/db.php';

if (isset($_POST['delete'])) {
  // Get form data
  $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

  $query = "DELETE FROM `posts` WHERE `id`=" . $delete_id;

  if (mysqli_query($conn, $query)) {
    header('Location: index.php');
  } else {
    echo 'ERROR: ' . mysqli_error($conn);
  }
}

// Get ID
$id = mysqli_real_escape_string($conn, $_GET['id']) ;

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
  <h1 class="panel-heading text-center text-uppercase"><?=$post['title']; ?></h1>
  <div class="container">
    <a href="index.php" class="btn btn-primary btn-sm">Back</a>
    <a href="editPost.php?id=<?=$post['id']; ?>" class="btn btn-warning btn-sm">Edit Post</a>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="pull-right">
      <input type="hidden" name="delete_id" value="<?=$post['id']; ?>">
      <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
    </form>
      <h3><?= $post['title']; ?></h3>
      <small>Created on <?= $post['create_data']; ?></small>
      <p><?= $post['body']; ?></p>
  </div>

<?php
include_once 'inc/footer.php';
