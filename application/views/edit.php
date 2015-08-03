<h1>Edit Item: <?= $item['item_name']; ?></h1>

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
<input type="hidden" name="id" value="<?= $item['id']; ?>" />
<input type="text" name="edit_item" value="<?= $item['item_name']; ?>" />
<input type="submit" name="submit" value="Update Item" />
</form>