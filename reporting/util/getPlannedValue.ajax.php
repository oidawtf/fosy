<?php
	require("db.inc.php");
	
	$query = "SELECT i.name, p.value as pValue, pv.value as pvValue, pvt.type, pv.id as pvID 
				FROM plannedValue pv 
				INNER JOIN indicator i on pv.fk_indicator_id = i.id 
				INNER JOIN period p on pv.fk_period_id = p.id 
				INNER JOIN plannedValue_type pvt on pv.fk_plannedValue_type_id = pvt.id 
				WHERE i.id=".$_GET['id'];

	
	$result = mysql_query($query);

	if($result && mysql_num_rows($result)) {
		echo "<table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'><thead class='ui-widget-header ui-corner-all'><tr><th>Kennzahl</th><th>Zeitraum</th><th>Planwert</th><th>&nbsp;</th></tr></thead><tbody>";
		$i = 0;	 // counter for layout
		while($row = mysql_fetch_assoc($result)) { 
?>
			<tr class="cell<?php echo $i%2; ?>">
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['pValue']; ?></td>
				<td class="right"><?php echo $row['pvValue']; ?> <?php echo $row['type']; ?></td>
				<td><a href="/reporting/index.php?content=editPlannedValue&pvID=<?php echo $row['pvID']; ?>">Edit</a> <a href="/reporting/index.php?content=deletePlannedValue&pvID=<?php echo $row['pvID']; ?>">Delete</a></td>
			</tr>
<?php		$i++;
		}
		echo "</tbody></table>";
	}else{
		echo "Für die ausgewählte Kennzahl sind keine Planwerte vorhanden.";
	}
	
	
?>