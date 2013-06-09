<?php
	require("db.inc.php");
	
	$query = "SELECT p1.id AS id, p1.value AS value FROM period p1 WHERE p1.value
				NOT IN (SELECT p2.value FROM period p2
				JOIN plannedvalue pv ON pv.fk_period_id = p2.id
				JOIN indicator i ON pv.fk_indicator_id = i.id
				WHERE pv.fk_indicator_id = ".$_GET['id']."
				GROUP BY p2.value)";
				
	$result = mysql_query($query);

	if($result && mysql_num_rows($result)) {
		echo "<label>Zeitraum:</label>\n";
		echo "<select id='periodSelect' name='periodSelect' class='ui-widget ui-widget-content ui-corner-all'><option value='0'><--wählen--></option>\n";
			
			while($row = mysql_fetch_assoc($result)) {
				echo "<option value=".$row['id'].">".$row['value']."</option>";
			}
		echo "</select>\n";
		
	}else{
		echo "Für die ausgewählte Kennzahl sind keine Zeitwerte vorhanden. This should never happen!";
	}
?>