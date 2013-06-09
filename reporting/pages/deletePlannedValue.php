<h2>Plandaten löschen</h2>
<?php
	if($_GET['delete']==1) {
		deletePlannedvalue($_GET['pvID']);
	}else {
		$plannedvalue = getPlannedvalue($_GET['pvID']);	
	}
	
?>
<br/>
<div>
	Sind Sie sicher, dass Sie den Planwert (<span class="bold"><?php echo $plannedvalue[0]['pvValue'] . " " . $plannedvalue[0]['pvtType']; ?></span>) für die Kennzahl (<span class="bold"><?php echo $plannedvalue[0]['iName']; ?></span>) und den Zeitraum (<span class="bold"><?php echo $plannedvalue[0]['pValue'];?></span>) löschen möchten?
</div>
<br/>
<div>
	<a class="button" href="<?php echo $_SERVER['PHP_SELF'];?>?content=deletePlannedvalue&pvID=<?php echo $_GET['pvID']; ?>&delete=1">Löschen</a>
	<a class="button" href="<?php echo $_SERVER['PHP_SELF'];?>?content=managePlannedvalue">Abbrechen</a>
</div>