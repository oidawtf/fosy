<?php

@controller::checkAuthentication();

if (isset($_GET['id']))
    $customer = controller::getCustomer($_GET['id']);
else
    $customer = new person();

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full" style="height:90%">
        <header>
            <h3 class="tabs_involved">Kundendetails</h3>
        </header>
        
        <div class="module_content">
            
            <fieldset style="width:32%; float:left; margin-right: 2%;">
                <label>Vorname</label>
                <input name="firstname" type="text" style="width:90%" />
            </fieldset>
            <fieldset style="width:32%; float:left; margin-right: 2%">
                <label>Nachname</label>
                <input name="lastname" type="text" style="width:90%;" />
            </fieldset>
            <fieldset style="width:31%; float:left;">
                <label>Titel</label>
                <input name="title" type="text" style="width:90%;" />
            </fieldset>
            
            
        </div>
        
        
    </article>
    
</section>