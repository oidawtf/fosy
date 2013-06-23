<?php
	require("../../shared/authenticationController.php");
	require("db.inc.php");
	
	$query = "SELECT i.name, p.value AS pValue, pv.value AS pvValue, pvt.type, pv.id AS pvID 
				FROM plannedvalue pv 
				INNER JOIN indicator i ON pv.fk_indicator_id = i.id 
				INNER JOIN period p ON pv.fk_period_id = p.id 
				INNER JOIN plannedvalue_type pvt ON pv.fk_plannedvalue_type_id = pvt.id 
				WHERE i.id=".$_GET['id'];

	$result = mysql_query($query);

	if($result && mysql_num_rows($result)) {
		echo "<br/><table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'><thead class='ui-widget-header ui-corner-all'><tr><th>Kennzahl</th><th>Zeitraum</th><th>Planwert</th><th>&nbsp;</th></tr></thead><tbody>";
		$i = 0;	 // counter for layout
		while($row = mysql_fetch_assoc($result)) { 
?>
			<tr class="cell<?php echo $i%2; ?>">
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['pValue']; ?></td>
				<td class="right"><?php echo $row['pvValue']; ?> <?php echo $row['type']; ?></td>
				<td>
					
						<ul id="icons" class="ui-widget ui-helper-clearfix">
							<a href="/reporting/index.php?content=editPlannedvalue&pvID=<?php echo $row['pvID']; ?>">
								<li class="ui-state-default ui-corner-all">
									<span class="ui-icon ui-icon-pencil"> </span>
								</li>
							</a>
							<a href="/reporting/index.php?content=deletePlannedvalue&pvID=<?php echo $row['pvID']; ?>">
								<li class="ui-state-default ui-corner-all">
									<span class="ui-icon ui-icon-trash"> </span>
								</li>
							</a>
						</ul>
					 
				</td>
			</tr>
<?php		$i++;
		}
		echo "</tbody></table>";
	}else{
		echo "Für die ausgewählte Kennzahl sind keine Planwerte vorhanden.";
	}
	
	
?>