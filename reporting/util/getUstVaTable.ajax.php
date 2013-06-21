<?php
	require("../../shared/authenticationController.php");
	require("db.inc.php");	
	require("dateFunctions.inc.php");
	
	// 1. create array with months passed the year
	$yearNow = date('Y');
	if((int)$_GET['year'] < (int)$yearNow) {
		$monthNow = 13;
	}else {
		$monthNow = date('n');
	}
	$passedMonths = array();
	for($i=1; $i < $monthNow; $i++) {
		array_push($passedMonths, $i);
	}

	// 2. get content from database
	if(count($passedMonths) > 0) {
		$query = "SELECT month, year, document FROM tax_report where year=".$_GET['year']." ORDER BY month ASC";
		$result = mysql_query($query);
		
		echo "<br><table cellpadding='0' cellspacing='0' class='ui-widget ui-widget-content ui-corner-all'><thead class='ui-widget-header ui-corner-all'><tr><th>&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Berichtszeitraum</th><th>Link</th></tr></thead><tbody>";
		
		$cellI = 0; // counter for layout
		$rows = array();

		// 3. check the result from the database
		if($result && mysql_num_rows($result)) {
		
			// 4. iterate for every date element over the result set and save it in a local array
			while($row = mysql_fetch_assoc($result)) {
				// we have elements in our database
				array_push($rows, $row);
			}
			
		}
		
		
		if(!empty($rows)) {
		
			// 5. iterate over date array
			foreach($passedMonths as $month) {

				$found = false;			
				foreach($rows as $row) {
				
					// 6. check if the result element is equal to the date element
					if($month == $row['month']) {
						$foundMonth = $row['month'];
						$foundYear = $row['year'];
						$foundDocument = $row['document'];
						$found = true;
						break;
					}else {
						$found = false;
					}
				}
				
				if($found) {
					echo "<tr class='cell".($cellI%2)."'>";
					echo "<td>&nbsp;</td>";	
					echo "<td>".getMonthShortName($foundMonth)." ".$foundYear."</td>";
					echo "<td>"; 
					if(strlen($row['document'])!=0) { echo "<a href='/reporting/".$foundDocument."' target='_blank'>Download</a>"; } 
					echo "</td>";
					echo "</tr>";
					$cellI++;
				}else {
					echo "<tr class='cell".($cellI%2)."'>";
					echo "<td><input type='checkbox' name='selectedMonth[]' class='month' id='month".$month."' value='".$month."-".$_GET['year']."'></td>";
					echo "<td>".getMonthShortName($month). " " .$_GET['year']."</td>";
					echo "<td>&nbsp;</td>";
					echo "</tr>";
					$cellI++;
				}
			}
		}else {
			foreach($passedMonths as $month) {
				echo "<tr class='cell".($cellI%2)."'>";
				echo "<td><input type='checkbox' name='selectedMonth[]' class='month' id='month".$month."' value='".$month."-".$_GET['year']."'></td>";
				echo "<td>".getMonthShortName($month). " " .$_GET['year']."</td>";
				echo "<td>&nbsp;</td>";
				echo "</tr>";
				$cellI++;
			}
		}
		
		echo "</tbody></table>";
	} else {
		// if date array empty show info
		echo "Für das ausgewählte Jahr sind keine Monate verstrichen!";

	}
?>