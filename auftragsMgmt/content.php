<?php
if(authenticationController::isLoggedIn()) {
  if(isset($_GET['content'])) {
    switch($_GET['content']) {
      case 'home':
      case 'AngebotErstellen':
      case 'AngebotVerwalten':
      case 'AuftragErstellen':
      case 'AuftrageVerwalten':
      case 'RechnungErstellen':
        include 'content/'.$_GET['content'].'.php';
        break;
    default:
      echo "<h1>404 - Sorry, Page ".$_GET['content']." not found.";
      break;
    }
  }
} else {
  include "login.php";
}
?>