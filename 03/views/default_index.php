<h1>Users</h1>
<div class="mb-2">
<a class="btn btn-primary" href="?action=Create">Create</a>
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
    <a class="btn btn-sm btn-outline-primary" href="?action=Edit&id=<?php echo $user['id']; ?>">Edit</a>
    <a class="btn btn-sm btn-outline-primary" href="?action=View&id=<?php echo $user['id']; ?>">View</a>
    <a class="btn btn-sm btn-outline-danger" href="?action=Delete&id=<?php echo $user['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>