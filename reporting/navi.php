<nav>
	<ul>
		<li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='dashboard') echo 'class="active"'; } ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=dashboard">Dashboard</a>
		</li>
        <li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='flexibleReports') echo 'class="active"'; } ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=flexibleReports">Flexible Reports</a>
		</li>
		<li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='erErfassen') echo 'class="active"'; } ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=erErfassen">ER erfassen</a>
		</li>
		<li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='ustVA') echo 'class="active"'; } ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=ustVA">UST VA</a>
		</li>
		<li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='plandatenverwaltung') echo 'class="active"'; } ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=plandatenverwaltung">Plandatenverwaltung</a>
		</li>
		<li>
			<a <?php if(isset($_GET['content'])) { if($_GET['content']=='planIstVergleich') echo 'class="active"'; } ?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=planIstVergleich">Plan-Ist-Vergleich</a>
		</li>
    </ul>
</nav>