<?php # Script 3.4 - index.php
include ('includes/session.php');

$page_title = 'Welcome to this Site!';
include ('./includes/header.php');
?>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/indianchat1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/indianchat2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/indianchat3.jpg" alt="Third slide">
            </div>
        </div>
    </div>
<?php
include ('./includes/footer.html');
?>