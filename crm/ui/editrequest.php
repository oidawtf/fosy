<?php

authenticationController::checkAuthentication();

if (isset($_GET['customerId'])) {
    $customerId = $_GET['customerId'];
}

if (isset($_GET['requestId'])) {
    $request = controller::getRequestById($_GET['requestId']);
    $command = 'editrequest';
}
else {
    $request = new request();
    $user = authenticationController::getUser();
    $request->responsible_userId = $user['id'];
    $request->responsible_user = $user['username'];
    $request->article_category_id = 1;
    $command = 'createrequest';
}

?>

<script type="text/javascript">
    
    function OnReloadArticles(select) {
        OnLoadArticles(select.options[select.selectedIndex].value);
    }
    
    function OnLoadArticles(article_category_id, article_id)
    {
        var xmlhttp = getXmlHttpRequest();
        var url = "ui/getArticles.php";
        var params = "article_category_id=" + article_category_id + "&article_id=" + article_id;

        xmlhttp.open("POST", url, true);

        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState===4 && xmlhttp.status===200)
                document.getElementById("articles").innerHTML=xmlhttp.responseText;
        };

        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Content-length", params.length);
        xmlhttp.setRequestHeader("Connection", "close");

        xmlhttp.send(params);
    }
    
</script>

<section id="main" class="column" style="height: 90%;">
    <article class="module width_full">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?content=customerdetails&customerId=".$customerId; ?>">
            <header>
                <h3>Kundenanfrage erfassen<?php echo $request->getIdFormatted(); ?></h3>
            </header>

            <div class="module_content">

                <fieldset style="width:150px; float:left; margin-right: 10px;">
                    <label>Klassifizierung</label>
                    <select name="request_type" style="width:92%;">
                        <?php
                        foreach (controller::getRequestTypes() as $item) {
                            if ($request->type == $item['name'])
                                $selected = "selected='selected'";
                            else
                                $selected = "";                          
                            
                            echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset style="width:150px; float:left; margin-right: 10px;">
                    <label>Sachbearbeiter</label>
                    <select name="responsible_userId" style="width:92%;">
                        <?php
                        foreach (authenticationController::getUsers() as $item) {
                            if ($request->responsible_userId == $item['id'])
                                $selected = "selected='selected'";
                            else
                                $selected = "";                            
                            
                            echo "<option ".$selected." value='".$item['id']."'>".utils::ConvertUser($item)."</option>";
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset style="width:150px; float:left; margin-right: 10px;">
                    <label>Artikel Kategorie</label>
                    <select name="article_category" onchange="OnReloadArticles(this)" style="width:92%;">
                        <?php
                        foreach (controller::getArticleCategories() as $item) {
                            if ($request->article_category_id == $item['id'])
                                $selected = "selected='selected'";
                            else
                                $selected = "";
                            
                            echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset style="width:300px; float:left;">
                    <label>Artikel</label>
                    <div id="articles"></div>
                    <script type="text/javascript">
                        OnLoadArticles(<?php echo $request->article_category_id.", ".$request->article_id; ?>);
                    </script>
                </fieldset>
                
                <fieldset class="clear">
                    <label>* Text</label>
                    <textarea name="text" required="1" maxlength="2048" rows="12"><?php echo $request->text; ?></textarea>
                </fieldset>

                <fieldset style="width:200px;">
                    <label>Status</label>
                    <select name="status" style="width:92%;">
                        <?php
                        foreach (controller::getStatus() as $item){
                            if ($request->status == $item['name'])
                                $selected = "selected='selected'";
                            else
                                $selected = "";
                            
                            echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
                        }
                        ?>
                    </select>
                </fieldset>
                
            </div>

            <footer>
                <div class="submit_link">
                    <input type="hidden" name="id" value="<?php echo $request->customerId; ?>" />
                    <input type="hidden" name="requestId" value="<?php echo $request->id; ?>" />
                    <input type="submit" class="alt_btn" name="<?php echo $command; ?>" value="Speichern" />
                    <input type="button" onclick="javascript:history.back()" value="Abbrechen" />
                </div>
            </footer>
        </form>
    </article>
    
    <div class="spacer clear"></div>
    
</section>
