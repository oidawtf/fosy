<div id="loginForm">
    <div id="logo">
        <img src="img/logo_120x40.png" alt="LOGO Programm: Felix Online Systems"/>
    </div>
    <!-- //TODO formatieren -->
    <hr />
    <br />
    <table id="loginTable">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=home">
            <tr>
                <td>Benutzername:</td>
                <td><input name="username" type="text" value="admin" placeholder="Bitte Benutzername eingeben"></td>
            </tr>
            <tr>
                <td>Kennwort:</td>
                <td><input name="password" type="password" value="hallo" placeholder="Bitte Kennwort eingeben"></td>
            </tr>
            <tr>
                <td><button type="submit" name="login">Login</button></td>
            </tr>
        </form>
    </table>
</div>