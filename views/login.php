<?php
    if(isset($_POST))
    {
        echo 'Post found';
        die();
    }

?>

<form action="/login.php">
    <button type="submit">login</button>
</form>
