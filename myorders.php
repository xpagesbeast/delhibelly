<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad() {
	echo '<p class="ad">This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p>';
} // End of the function definition.

$page_title = 'Welcome to this Site!';
include ('includes/header.html');

// Call the function:
//create_ad();
?>
    <div class="container">
        <h1>Show order history if User is logged in</h1>
    </div>
<?php

// Call the function again:
//create_ad();

include ('includes/footer.html');
?>