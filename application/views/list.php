<h1>To Do</h1>

<?php
if(isset($messages) && array_key_exists('success', $messages))
{
    foreach($messages as $message)
    {
        echo '<div class="message success">' . $message . '</div>';
    }
}
if(isset($messages) && array_key_exists('error', $messages))
{
    foreach($messages as $message)
    {
        echo '<div class="message error">' . $message . '</div>';
    }
}
?>

<?= validation_errors(); ?>
<?= form_open(); ?>
<input type="text" name="add_item" value="" />
<input type="submit" name="submit" value="Create Item" />
</form>
<br/> <br />
<?php
if(is_array($active_list) && count($active_list) > 0)
{
    echo'<h2>Incomplete Items</h2>';
	echo '<ul>';
	foreach($active_list as $item)
	{
		echo '<li>' . $item['item_name'] . ' <a href="/edit/' . $item['id'] . '">Edit</a> | <a href="/complete/' . $item['id'] . '">Mark as Complete</a></li>';
	}
	echo '</ul>';
}
?>

<br/> <br />
<?php
if(is_array($inactive_list) && count($inactive_list) > 0)
{
    echo '<h2>Complete Items</h2>';
	echo '<ul>';
	foreach($inactive_list as $item)
	{
		echo '<li>' . $item['item_name'] . ' <a href="/reinstate/' . $item['id'] . '">Reinstate</a></li>';
	}
	echo '</ul>';
}
?>