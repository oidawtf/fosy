<?php
/*
	inputformat: yyyy-mm-dd
	outputformat: dd.mm.yy
*/
function formatDateForOutput($date) {
	return date('d.m.Y', strtotime($date));
}

?>