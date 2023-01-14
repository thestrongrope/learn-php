<?php
  require 'connect.php';

  $validations = [];  

  $user = ['name'=>'', 'email'=>'', 'city'=>''];

  if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $user = $_POST['user'] ?? $user;
    
    if(empty($user['name'])) {
      $validations['name'] = "Please provide a name";
    }
    if(empty($user['email'])) {
      $validations['email'] = "Please provide an email";
    }
    if(empty($user['city'])) {
      $validations['city'] = "Please provide a city";
    }

    if(count($validations) == 0) {
      $sql = 'INSERT INTO users(name, email, city) VALUES(:name, :email, :city)';
      $query = $pdo->prepare($sql);
      $query->execute($user);
      $_SESSION['message'] = 'User added successfully';
      header('Location: index.php');
    }
  }

  require 'header.php';
?>

    <h1>Create User</h1>

    <?php if(count($validations)) { ?>
      <h5 class="text-danger">Errors:</h5>
      <ul class="list-group bg-danger text-danger">
      <?php foreach($validations as $validation) { ?>
        <li class="list-group-item"><?php echo $validation; ?></li>
      <?php } ?>
      </ul>
    <?php } ?>
    <form method="post">
      <div class="mt-2">
          <label for="name">Name</label>
          <input name="user[name]" 
              value="<?php echo $user['name']; ?>"
              class="form-control" id="name" 
              type="text">
      </div>
      <div class="mt-2">
          <label for="email">Email</label>
          <input name="user[email]" 
            value="<?php echo $user['email']; ?>"
            class="form-control" id="email" type="email">
      </div>
      <div class="mt-2">
          <label for="city">City</label>
          <input name="user[city]"  
            value="<?php echo $user['city']; ?>"          
            class="form-control" id="city" type="text">
      </div>
      <div class="mt-2">
        <button class="btn btn-primary">Save User</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>

<?php
    require 'footer.php';