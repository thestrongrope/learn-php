<?php
  require 'connect.php';
  $sql = 'SELECT * FROM users';
  $result = $pdo->query($sql);
  $users = $result->fetchAll();

  $message = null;
  $error = null;

  if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
  }

  if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
  }

  require 'header.php';
?>

  <?php if ($message) { ?>
  <div class="alert alert-success"><?php echo $message; ?></div>
  <?php } ?>

  <?php if ($error) { ?>
  <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php } ?>

  <h1>Users</h1>
  <div class="mb-2">
    <a class="btn btn-primary" href="create.php">Create</a>
  </div>
  <table class="table table-bordered table-striped table-hover">
    <tr>
      <th>Sr No</th>
      <th>Name</th>
      <th>Email</th>
      <th>City</th>
      <th>Actions</th>
    </tr>
    <?php foreach($users as $idx => $user) { ?>
    <tr>
      <td><?php echo $idx + 1; ?></td>
      <td><?php echo $user['name']; ?></td>
      <td><?php echo $user['email']; ?></td>
      <td><?php echo $user['city']; ?></td>
      <td>
      <a class="btn btn-sm btn-outline-primary" href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
      <a class="btn btn-sm btn-outline-primary" href="view.php?id=<?php echo $user['id']; ?>">View</a>
      <a class="btn btn-sm btn-outline-danger" href="delete.php?id=<?php echo $user['id']; ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
<?php
    require 'footer.php';