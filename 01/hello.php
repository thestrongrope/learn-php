<?php

$greeting = $_GET['greeting'] ?? 'Hello';
$person = $_GET['person'] ?? 'World';

?>

<form>
    <input name="greeting" type="text" />
    <input name="person" type="text" />
    <input type="submit" value="Submit" />
</form>

<h1><?php echo $greeting; ?> <?php echo $person; ?></h1>


