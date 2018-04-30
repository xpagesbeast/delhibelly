<?php
include ('../includes/session.php');
highLightNavigationTab('order');

require_once "ShoppingCart.php";

$member_id = 2; // you can your integerate authentication module here to get logged in member

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
$page_title = 'Make an Order';
include ('../includes/header.php');
?>

<div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Shopping Cart</div>

            <a id="btnEmpty" href="../menu.php?action=empty"><img
                src="image/empty-cart.png" alt="empty-cart"
                title="Empty Cart" class="float-right" /></a>
            <div class="cart-status">
                <div>Total Quantity: <?php echo $item_quantity; ?></div>
                <div>Total Price: <?php echo $item_price; ?></div>
            </div>
        </div>
        <?php
        if (! empty($cartItem)) {
            ?>
<?php
            require_once ("cart-list.php");
            ?>
<?php
        } // End if !empty $cartItem
        $shoppingCart->emptyCart($member_id);
        ?>

</div>
    
    <div class="success">
        Thank you for shopping with us. Your order has been placed. You order Id is <?php echo $_GET["item_number"]; ?>
    </div>
    <div>
        <a href="./"><button class="btn-continue">Continue Shopping</button></a>
    </div>
<?php
include ('../includes/footer.html');
?>
<script>

    highlightNavItem('nav-item', 'nav-order');


</script>
</body>
</html>
</HTML>