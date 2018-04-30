<?php
include ('includes/session.php');
highLightNavigationTab('order');

require_once "cartandpayment/ShoppingCart.php";
//$member_id = 2; // you can your integerate authentication module here to get logged in member
$member_id = $_SESSION['user_id'];

$shoppingCart = new ShoppingCart();
?>

<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
        }
    }
}
?>

<?php
$page_title = 'Make an Order - Checkout';
include ('includes/header.php');
?>
<div class="row">
<div class="col-md-6">
    <form name="frm_customer_detail" action="process-order.php" method="POST">
        <div class="frm-heading">
            <div class="txt-heading-label">Customer Details</div>
        </div>
        <div class="frm-customer-detail">
            <div class="form-row">
                <div class="input-field">
                    <input type="text" name="name" id="name"
                           PlaceHolder="Customer Name" required>
                </div>

                <div class="input-field">
                    <input type="text" name="address" PlaceHolder="Address" required>
                </div>
            </div>

            <div class="form-row">
                <div class="input-field">
                    <input type="text" name="city" PlaceHolder="City" required>
                </div>

                <div class="input-field">
                    <input type="text" name="state" PlaceHolder="State" required>
                </div>
            </div>

            <div class="form-row">
                <div class="input-field">
                    <input type="text" name="zip" PlaceHolder="Zip Code" required>
                </div>

                <div class="input-field">
                    <input type="text" name="country" PlaceHolder="Country" required>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-success"
                   name="proceed_payment" value="Proceed to Payment">
        </div>
    </form>
</div>

<div id="shopping-cart" class="col-md-6">
    <div class="alert alert-success">
        <div class="txt-heading-label">Shopping Cart</div>

        <a id="btnEmpty" href="menu.php?action=empty"><img
                src="cartandpayment/image/empty-cart.png" alt="empty-cart"
                title="Empty Cart" class="float-right" /></a>
        <div class="cart-status">
            <div>Total Quantity: <?php echo $item_quantity; ?></div>
            <div>Total Price: $ <?php echo $item_price; ?></div>
        </div>
    </div>
    <?php
    if (! empty($cartItem)) {
        ?>
        <?php
        require_once ("cartandpayment/cart-list.php");
        ?>
        <?php
    } // End if !empty $cartItem
    ?>

</div>
</div>
<?php
include ('includes/footer.html');
?>
<script>

    highlightNavItem('nav-item', 'nav-order');


</script>
</body>
</HTML>