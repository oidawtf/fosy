<div>
	<?php
		require("../util/pdfFunctions.php");
	?>

	<table>
		<tr>
			<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>?content=AngebotErstellen">
			<td>Kundennummer / Name:</td>
			<td><input type="text" name="search"></td>
			<td><input type="submit" name="searchButton" value="suchen">
		</tr>
	</table>
		
		<?php
			if(isset($_POST['search']) && isset($_POST['searchButton'])){
				createCustomerPDF($_POST['search']);
		}
                ?>
</div>