<?php

@controller::checkAuthentication();

if (isset($_GET['id']))
    $customer = controller::getCustomer($_GET['id']);

?>

<section id="main" class="column" style="height: 90%;">
    
    <article class="module width_full">
        <header>
            <h3 class="tabs_involved">Kundendetails</h3>
        </header>
        
        
        
    </article>
    
</section>