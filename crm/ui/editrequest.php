<?php

@controller::checkAuthentication();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['requestId'])) {
    $request = controller::getRequestById($_GET['requestId']);
    $command = 'editrequest';
}
else {
    $request = new request();
    $command = 'createrequest';
}

?>

<section id="main" class="column" style="height: 90%;">
    <article class="module width_full">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?content=customerdetails&id=".$id; ?>">
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
                    <label>Artikeltyp</label>
                    <select name="article_category" style="width:92%;">
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
                    <select name="article" style="width:92%;">
                        <?php
                        // TODO Article category: wenn sich die aendert, dann auch die liste der artikel aendern
                        foreach (controller::getArticles(1) as $item) {
                            if ($request->articleId == $item['id'])
                                $selected = "selected='selected'";
                            else
                                $selected = "";
                            
                            echo "<option ".$selected." value='".$item['id']."'>".$item['name']."</option>";
                        }
                            
                        ?>
                    </select>
                </fieldset>
                
                <fieldset class="clear">
                    <label>Text</label>
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
                    <input type="submit" class="alt_btn" name=""<?php echo $command; ?>" value="Speichern" />
                    <input type="button" onclick="javascript:history.back()" value="Abbrechen" />
                </div>
            </footer>
        </form>
    </article>
</section>