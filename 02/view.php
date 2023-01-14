<?php
    require 'connect.php';

    $id = $_GET['id'] ?? 0;
    $sql = 'SELECT * FROM users WHERE id=:id';
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id]);
    $user = $query->fetch();

    if(!$user) {
        $_SESSION['error'] = 'No such user';
        header('Location: index.php');
    }
    
  require 'header.php';
?>

    <h1>View User [<?php echo $user['name']; ?>]</h1>

    <form method="post">
      <input type="hidden" name="user[id]" value="<?php echo $id; ?>" />
      <div class="mt-2">
          <label for="name">Name</label>
          <input name="user[name]" disabled 
              value="<?php echo $user['name']; ?>"
              class="form-control" id="name" 
              type="text">
      </div>
      <div class="mt-2">
          <label for="email">Email</label>
          <input name="user[email]" disabled
            value="<?php echo $user['email']; ?>"
            class="form-control" id="email" type="email">
      </div>
      <div class="mt-2">
          <label for="city">City</label>
          <input name="user[city]" disabled
            value="<?php echo $user['city']; ?>"          
            class="form-control" id="city" type="text">
      </div>
      <div class="mt-2">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>

<?php
    require 'footer.php';