<?php
	if($_GET['pvID'] == "") {
		echo "<h2>Plandaten hinzufügen</h2>";
	}else {
		echo "<h2>Plandaten bearbeiten</h2>";
	}
?>

<?php echo $_GET['pvID']; ?>

