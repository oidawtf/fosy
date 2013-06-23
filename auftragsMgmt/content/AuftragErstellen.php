<div>
<?php
	displayOfferSearchBar();
	if(isset($_POST['search']) && isset($_POST['searchButton'])){
		findOffers($_POST['search'],true);
	}
?>
</div>