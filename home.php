<?php

echo "Login erfolgreich!</br>";

?>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <button type="submit" name="logout">Logout</button>
</form>
