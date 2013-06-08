<?php

require '../includes.php';

controller::checkAuthentication();

if (!isset($_POST['article_category_id']))
    return;

echo "<select name='article' style='width:92%;'>";

foreach (controller::getArticles($_POST['article_category_id']) as $item) {
    if ($request->articleId == $item['id'])
        $selected = "selected='selected'";
    else
        $selected = "";

    echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
}

echo "</select>";

?>
