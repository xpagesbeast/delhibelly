<?php # Script 3.4 - index.php
include ('includes/session.php');

$page_title = 'Welcome to this Site!';
include ('./includes/header.php');
?>
    <div class="container">
        <h1>Show order history if User is logged in</h1>
    </div>
<?php

// Call the function again:
//create_ad();

include ('includes/footer.html');
?>