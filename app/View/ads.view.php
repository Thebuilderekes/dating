<?php

namespace App\View;

// $products = include "../Products.php";
ob_start()
?>
<aside>
    <h2>Ads go here</h2>
    <h2>Ads go here</h2>
    <h2>Ads go here</h2>
</aside> 
<?php
 return ob_get_clean();
