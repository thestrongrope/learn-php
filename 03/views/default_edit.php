<h1>Edit User [<?php echo $user['name']; ?>]</h1>

<form method="post">
  <input type="hidden" name="user[id]" value="<?php echo $id; ?>" />
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
