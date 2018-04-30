<?php # Script 3.4 - index.php
include('includes/session.php');
highLightNavigationTab('history');

if(!$_SESSION['user_id']){
    header("location:login.php");
    die;
}

//$member_id = 2; // you can your integerate authentication module here to get logged in member
$member_id = $_SESSION['user_id'];
require_once "cartandpayment/ShoppingCart.php";

$shoppingCart = new ShoppingCart();

$queryOrderHeaders = "SELECT tbl_order.id as order_id, tbl_order.amount, tbl_order.name, tbl_order.address, tbl_order.city, tbl_order.state, tbl_order.zip, tbl_order.country, tbl_order.order_status, tbl_order.order_at as order_date FROM `tbl_order`  WHERE tbl_order.customer_id = " . $member_id . " ORDER BY tbl_order.order_at DESC";

$myorders_array = $shoppingCart->getAllOrders($queryOrderHeaders);

$page_title = 'Delhibelly - Order History';
include('./includes/header.php');

?>

<div class="container">

    <div class="row">
        <h1><?php echo $user_name ?>'s Order History</h1>
    </div>

    <div class="row">


        <?php

        setlocale(LC_MONETARY, 'en_US');

        if (!empty($myorders_array)) {

            foreach ($myorders_array as $key => $value) {
                $orderId = $myorders_array[$key]["order_id"];
                $amount = $myorders_array[$key]["amount"];
                echo '<div class="col-12"  style="margin-top:20px;">';
                echo '<div class="card">';
                echo '<div class="card-header alert-info"><div class="title"><strong>Order ID ' . $orderId . ' placed on ' . $myorders_array[$key]["order_date"] . '</strong> </div></div>';
                echo '<div class="card-body table-responsive">';

                //now get the order lines
                $queryOrderDetails = "SELECT tbl_order_item.item_price, tbl_order_item.quantity, tbl_product.name as product_name, tbl_product.code as product_code, tbl_product.image as product_image, tbl_product.price as product_price, ROUND(tbl_order_item.quantity * tbl_order_item.item_price,2) as subtotal FROM `tbl_order_item` LEFT OUTER JOIN tbl_product on tbl_order_item.product_id = tbl_product.id WHERE tbl_order_item.order_id = " . $orderId;
                $myorderdetails_array = $shoppingCart->getAllOrders($queryOrderDetails);

                if (!empty($myorderdetails_array)) {
                    echo '<table class="table table-striped table-borderless">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Item</th>';
                    echo '<th>Name</th>';
                    echo '<th style=\'text-align:right\'>Qty</th>';
                    echo '<th style=\'text-align:right\'>Price</th>';
                    echo '<th style=\'text-align:right\'>Subtotal</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody class="no-border-x">';

                    foreach ($myorderdetails_array as $key => $value) {

                        echo "<tr>";
                        echo "<td>" . (intval($key) + 1) . "</td>";
                        echo "<td>" . $myorderdetails_array[$key]["product_name"] . "</td>";
                        echo "<td style='text-align:right'>" . $myorderdetails_array[$key]["quantity"] . "</td>";
                        echo "<td style='text-align:right'>$" . money_format('%i', $myorderdetails_array[$key]["item_price"]) . "</td>";
                        echo "<td style='text-align:right'>$" . money_format('%i', $myorderdetails_array[$key]["subtotal"]) . "</td>";
                        echo "</tr>";

                    }
                    echo '<tr><td colspan="5">' . '<strong><span class="float-right">Total: $' . money_format('%i', $amount) . '</span></strong>' . "</td></tr>";
                    echo "</tbody></table>";
                    echo "</div><!-- card body -->";
                    echo "</div><!-- card -->";
                }



                echo '</div> <!-- end column -->';
                echo '<br />';
            }
        }
        ?>


    </div> <!-- end row -->
</div><!-- container -->
<?php

// Call the function again:
//create_ad();

include('includes/footer.html');
?>
<script>

    highlightNavItem('nav-item', 'nav-history');


</script>
</body>
</html>
