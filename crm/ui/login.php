<section id="main" class="column">
    <div id="login">
        <div id="logo">
            <img src="../img/logo_120x40_transparent.png" alt="Programm: Felix Online Systems"/>
        </div>

        <?php controller::getLoginMessage(); ?>

        <form id="loginForm" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <fieldset>
                <label>Benutzername:</label>
                <input name="username" type="text" style="width:92%" value="admin" placeholder="Bitte Benutzername eingeben">
            </fieldset>
            <fieldset>
                <label>Kennwort:</label>
                <input name="password" type="password" style="width:92%" value="hallo" placeholder="Bitte Kennwort eingeben">
            </fieldset>
            <input type="submit" name="login" value="Login" />
        </form>
    </div>
</section>
