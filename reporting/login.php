<div id="loginForm">
    <div id="logo">
        <img src="img/logo_120x40.png" alt="Programm: Felix Online Systems"/>
    </div>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?content=dashboard"; ?>">
		<table id="loginTable">
			<tr>
				<td><label>Benutzername:</label></td>
				<td><input class="ui-widget ui-widget-content ui-corner-all" name="username" type="text" value="admin" placeholder="Bitte Benutzername eingeben"></td>
			</tr>
			<tr>
				<td><label>Kennwort:</label></td>
				<td><input class="ui-widget ui-widget-content ui-corner-all" name="password" type="password" value="hallo" placeholder="Bitte Kennwort eingeben"></td>
			</tr>
			<tr>
				<td><button type="submit" name="login">Login</button></td>
			</tr>
		</table>
	</form>
</div>