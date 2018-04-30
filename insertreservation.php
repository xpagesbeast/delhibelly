<?php
include ('includes/session.php');
highLightNavigationTab('reservation');

$member_id = $_SESSION['user_id'];
require_once "cartandpayment/ShoppingCart.php";


$shoppingCart = new ShoppingCart();
$debug = '<br /> checking for _POST';

try{
if(!empty($_POST)) {
    //$date, $guests, $userId, $starttime
    $debug += '<br /> this is a POST, calling shopping cart.inserReservation.';
    $reservation = $shoppingCart->insertReservation ( $_POST["DATE"], $_POST["GUESTS"],$member_id,$_POST["START_TIME"]);
    $debug += '<br /> done with inserting data.';
}else{
    $debug += '<br /> no POST action';
}

$queryReservations = "SELECT RESERVATIONS.DATE, RESERVATIONS.GUESTS, RESERVATIONS.ID, RESERVATIONS.START_TIME, RESERVATIONS.USER_ID FROM RESERVATIONS WHERE RESERVATIONS.USER_ID = " . $member_id;

}catch (Exception $e){
    $debug += 'EXCEPTION ' . $e->getMessage();
}

$debug += 'querying db for all reservations.';
$myreservations_array = $shoppingCart->getAllReservations($queryReservations);

require_once "php/get-events.php";

$page_title = 'Delhibelly - Online Reservations';
include ('includes/header.php');



?>
<div class="container">
<div class="row">
    <?php echo $calEvents ?>
</div>

<div class="row">
    <?php echo $debug ?>
</div>
</div>