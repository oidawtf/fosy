<div id="loginForm">
    <div id="logo">
        <img src="img/logo_120x40.png" alt="Programm: Felix Online Systems"/>
    </div>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <fieldset>
            <label>Benutzername:</label>
            <input name="username" type="text" value="admin" placeholder="Bitte Benutzername eingeben">
        </fieldset>
        <fieldset>
            <label>Kennwort:</label>
            <input name="password" type="password" value="hallo" placeholder="Bitte Kennwort eingeben">
        </fieldset>
        <button type="submit" name="login">Login</button>
    </form>
</div>