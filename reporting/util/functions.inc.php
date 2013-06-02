<?php
function redirect($target) {
	echo '<script language="javascript">';
	echo 'window.location.href="'.$_SERVER["PHP_SELF"].'?content='.$target.'";';
	echo '</script>';
}

?>