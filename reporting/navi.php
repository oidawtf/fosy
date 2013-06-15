<nav>
	<ul>
		<li>
			<a <?php 
				if(isset($_GET['content'])) { 
					if($_GET['content']=='dashboard') {
						echo 'class="ui-state-activeFOSY"'; 
					}  
				}
			?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=dashboard">Dashboard</a>
		</li>
        <li>
			<a <?php 
				if(isset($_GET['content'])) { 
					if($_GET['content']=='flexibleReports') {
						echo 'class="ui-state-activeFOSY"'; 
					}
				}
			?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=flexibleReports">Flexible Reports</a>
		</li>
		<li>
			<a <?php 
				if(isset($_GET['content'])) { 
					if(	$_GET['content']=='addIncomminginvoice' || 
						$_GET['content']=='addIncomminginvoiceSuccess') {
						echo 'class="ui-state-activeFOSY"';
					}
				}
			?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=addIncomminginvoice">ER erfassen</a>
		</li>
		<li>
			<a <?php 
				if(isset($_GET['content'])) { 
					if(	$_GET['content']=='manageUstVa' || 
						$_GET['content']=='ustVaPrintedSuccess') {
						echo 'class="ui-state-activeFOSY"';
					} 
				}
			?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=manageUstVa">UST VA</a>
		</li>
		<li>
			<a <?php 
				if(isset($_GET['content'])) { 
					if(	$_GET['content']=='managePlannedvalue' || 
						$_GET['content']=='addPlannedvalue' || 
						$_GET['content']=='addPlannedvalueSuccess' || 
						$_GET['content']=='editPlannedvalue' || 
						$_GET['content']=='editPlannedvalueSuccess' ||
						$_GET['content']=='deletePlannedvalue' || 
						$_GET['content']=='deletePlannedvalueSuccess') {
						echo 'class="ui-state-activeFOSY"';
					}
				}  
			?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=managePlannedvalue">Plandatenverwaltung</a>
		</li>
		<li>
			<a <?php 
				if(isset($_GET['content'])) { 
					if($_GET['content']=='planIstVergleich') {
						echo 'class="ui-state-activeFOSY"'; 
					}  
				}
			?> href="<?php echo $_SERVER['PHP_SELF']; ?>?content=planIstVergleich">Plan-Ist-Vergleich</a>
		</li>
    </ul>
</nav>