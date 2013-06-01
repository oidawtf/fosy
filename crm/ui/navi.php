<aside class="column" id="sidebar" style="height: 1724px;">
       
    <form class="quick_search">
        <input type="text" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Quick Search">
    </form>
    <hr>
    
    <h3>Auftragsmanagement <a class="toggleLink" href="#"></a></h3>
    <ul class="toggle">
    </ul>
    
    <h3>CRM <a class="toggleLink" href="#"></a></h3>
    <ul class="toggle">
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='customerrequest'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">Kundenanfrage</a>
        </form>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='maintaincustomer'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">Kundenverwaltung</a>
        </form>
    </ul>
    
    <h3>Reporting <a class="toggleLink" href="#"></a></h3>
    <ul class="toggle">
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='dashboard'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">Dashboard</a>
        </form>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='hugo'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">Flexible Reports</a>
        </form>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='hugo'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">ER erfassen</a>
        </form>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='hugo'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">UST VA</a>
        </form>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='hugo'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">Plandatenverwaltung</a>
        </form>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type='hidden' name='content' value='hugo'>
            <a class="menu" href="javascript:;" onclick="parentNode.submit();">Plan-Ist-Vergleich</a>
        </form>
    </ul>
    
</aside>
