<navi>
    <aside class="column" id="sidebar" style="height: 90%;">

        <form class="quick_search">
            <input type="text" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Quick Search">
        </form>
        <hr>

        <h3>Auftragsmanagement <a class="toggleLink" href="#"></a></h3>
        <ul class="toggle">
            <li><a class="menu" href="../auftragsMgmt/index.php?content=angebot">Angebot legen</a></li>
        </ul>

        <h3>CRM <a class="toggleLink" href="#"></a></h3>
        <ul class="toggle">
            <li class="icn_view_users"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=maintaincustomer"><?php echo controller::getContentItem('maintaincustomer')->getTitle(); ?></a></li>
            <li class="icn_add_user"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=createcustomer"><?php echo controller::getContentItem('createcustomer')->getTitle(); ?></a></li>
            <li class="icn_edit_article"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=customerrequest"><?php echo controller::getContentItem('customerrequest')->getTitle(); ?></a></li>
            <li class="icn_new_article"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=createcampaign"><?php echo controller::getContentItem('createcampaign')->getTitle(); ?></a></li>
            <li class="icn_categories"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=analysecampaign"><?php echo controller::getContentItem('analysecampaign')->getTitle(); ?></a></li>
        </ul>

        <h3>Reporting <a class="toggleLink" href="#"></a></h3>
        <ul class="toggle">
            <li><a class="menu" href="../reporting/index.php?content=dashboard">Dashboard</a></li>
            <li><a class="menu" href="../reporting/index.php?content=flexibleReports">Flexible Reports</a></li>
            <li><a class="menu" href="../reporting/index.php?content=erErfassen">ER erfassen</a></li>
            <li><a class="menu" href="../reporting/index.php?content=ustVA">UST VA</a></li>
            <li><a class="menu" href="../reporting/index.php?content=plandatenverwaltung">Plandatenverwaltung</a></li>
            <li><a class="menu" href="../reporting/index.php?content=planIstVergleich">Plan-Ist-Vergleich</a></li>
        </ul>

    </aside>
</navi>