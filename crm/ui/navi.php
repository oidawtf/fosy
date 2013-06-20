<navi>
    <aside class="column" id="sidebar" style="height: 90%;">

        <form class="quick_search" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="content" value="showcustomers" />
            <input type="text" style="width:70%" name="search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Kundensuche...">
            <input type="submit" style="width:25%" value="Suchen" />
        </form>
        <hr>

        <h3>Auftragsmanagement <a class="toggleLink" href="#"></a></h3>
        <ul class="toggle">
            <li><a class="menu" href="../auftragsMgmt/index.php?content=AngebotErstellen">Angebot erstellen</a></li>
            <li><a class="menu" href="../auftragsMgmt/index.php?content=AngebotVerwalten">Angebote verwalten</a></li>
            <li><a class="menu" href="../auftragsMgmt/index.php?content=AuftragErstellen">Autrag erstellen</a></li>
            <li><a class="menu" href="../auftragsMgmt/index.php?content=AuftrageVerwalten">Auftr&auml;ge verwalten</a></li>
            <li><a class="menu" href="../auftragsMgmt/index.php?content=RechnungErstellen">Rechnung erstellen</a></li>
        </ul>

        <h3>CRM <a class="toggleLink" href="#"></a></h3>
        <ul class="toggle">
            <li class="icn_view_users"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=showcustomers"><?php echo controller::getContentItem('showcustomers')->getTitle(); ?></a></li>
            <li class="icn_add_user"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=createcustomer"><?php echo controller::getContentItem('createcustomer')->getTitle(); ?></a></li>
            <li class="icn_categories"><a class="menu" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=showcampaigns"><?php echo controller::getContentItem('showcampaigns')->getTitle(); ?></a></li>
            <li class="icn_new_article"><a class="menu <?php echo controller::isAuthorized('editcampaign') ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?content=editcampaign"><?php echo controller::getContentItem('editcampaign')->getTitle(); ?></a></li>
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