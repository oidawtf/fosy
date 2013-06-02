<nav>
	<ul>
		<li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='dashboard') echo 'class="ui-state-active"'; }  ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=dashboard">Dashboard</a>
		</li>
        <li>
			<a class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-corner-right<?php if(isset($_GET['content'])) { if($_GET['content']=='flexibleReports') echo ' ui-state-active'; }  ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=flexibleReports">Flexible Reports</a>
		</li>
		<li>
			<a class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-all<?php if(isset($_GET['content'])) { if($_GET['content']=='erErfassen') echo ' ui-state-active'; } ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=erErfassen">ER erfassen</a>
		</li>
		<li>
			<a class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-corner-right<?php if(isset($_GET['content'])) { if($_GET['content']=='ustVA') echo ' ui-state-active'; }  ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=ustVA">UST VA</a>
		</li>
		<li>
			<a class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-corner-right<?php if(isset($_GET['content'])) { if($_GET['content']=='plandatenverwaltung') echo ' ui-state-active'; }  ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=plandatenverwaltung">Plandatenverwaltung</a>
		</li>
		<li>
			<a class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-corner-right<?php if(isset($_GET['content'])) { if($_GET['content']=='planIstVergleich') echo ' ui-state-active'; }  ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=planIstVergleich">Plan-Ist-Vergleich</a>
		</li>
    </ul>
</nav>