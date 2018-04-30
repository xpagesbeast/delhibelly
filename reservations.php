<?php # Script 3.4 - index.php
include ('includes/session.php');
highLightNavigationTab('reservation');

if(!$_SESSION['user_id']){
    header("location:login.php");
    die;
}

$member_id = $_SESSION['user_id'];
require_once "cartandpayment/ShoppingCart.php";

$shoppingCart = new ShoppingCart();

$queryReservations = "SELECT RESERVATIONS.DATE, RESERVATIONS.GUESTS, RESERVATIONS.ID, RESERVATIONS.START_TIME, RESERVATIONS.USER_ID, RESERVATIONS.PURPOSE FROM RESERVATIONS WHERE RESERVATIONS.USER_ID = " . $member_id;

$myreservations_array = $shoppingCart->getAllReservations($queryReservations);

require_once "php/get-events.php";

$page_title = 'Delhibelly - Online Reservations';
include ('includes/header.php');

?>
<form name="insertreservation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row">
    <div class="col-12">
        <h1>Online Reservations</h1>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newReservationModal">Create a New Reservation</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="calendar"></div>
    </div>
</div>

<div class="modal fade" id="newReservationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="DESCRIPTION">Short Description</label>
                    <input type="text" class="form-control" id="DESCRIPTION" aria-describedby="date" placeholder="Lunch/Dinner/Birthday" required>
                </div>
                <div class="form-group">
                    <label for="DATE">Date</label>
                    <input type="text" class="form-control" id="DATE" aria-describedby="date" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="START_TIME">Time</label>
                    <input type="text" class="form-control" id="START_TIME" placeholder="HH:MM" required>
                </div>
                <div class="form-group">
                    <label for="GUESTS">Number of guests</label>
                    <input type="text" class="form-control" id="GUESTS" placeholder="numeric" required>
                </div>
            </div>
            <div class="modal-footer">
                <button name="submit" id="submit" type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</form>
<?php

    include ('includes/footer.html');
?>
<script>

    $(document).ready(function() {
        console.log("executing document.ready.");
        $('#calendar').fullCalendar({
            defaultDate: '<?php echo date("Y/m/d"); ?>',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events:<?php echo $calEvents ?>
        });

    });
console.log("reached end of load script tag.");
</script>
<style>
/*
    body {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }
*/
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>
<script>

    highlightNavItem('nav-item', 'nav-reservation');


</script>
</body>
</html>