<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


</head>
<body>

<h1>To Do</h1>

<?= validation_errors(); ?>
<?= form_open(); ?>
<input type="text" name="add_item" value="" />
<input type="submit" name="submit" value="Create Item" />
</form>
<br/> <br />
<?php
if(is_array($active_list) && count($active_list) > 0)
{
	echo '<ul>';
	foreach($active_list as $item)
	{
		echo '<li>' . $item['item_name'] . ' <a href="/edit">Edit</a> | <a href="/todo/complete/' . $item['id'] . '">Mark as Complete</a></li>';
	}
	echo '</ul>';
}
?>

<br/> <br />
<?php
if(is_array($inactive_list) && count($inactive_list) > 0)
{
	echo '<ul>';
	foreach($inactive_list as $item)
	{
		echo '<li>' . $item['item_name'] . ' <a href="/index.php/reinstate">Reinstate</a></li>';
	}
	echo '</ul>';
}
?>

</body>
</html>