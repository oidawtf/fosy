<?php

require_once '../../shared/authenticationController.php';
require_once '../includes.php';

authenticationController::checkAuthentication();

if (!isset($_POST['article_category_id']) || !isset($_POST['article_id']))
    return;

$article_category_id = $_POST['article_category_id'];
$article_id = $_POST['article_id'];

echo "<select name='article' style='width:92%;'>";
foreach (controller::getArticles($article_category_id) as $item) {
    if ($article_id == $item['id'])
        $selected = "selected='selected'";
    else
        $selected = "";

    echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
}

echo "</select>";

?>
