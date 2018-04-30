<?php
include ('includes/session.php');
highLightNavigationTab('order');


require_once "cartandpayment/ShoppingCart.php";

//$member_id = 2; // you can your integerate authentication module here to get logged in member
$member_id = $_SESSION['user_id'];

$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {

                $productResult = $shoppingCart->getProductByCode($_GET["code"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                if (! empty($cartResult)) {
                    // Update cart item quantity in database
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    // Add to cart table
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
                }
            }
            break;
        case "remove":
            // Delete single entry from the cart
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Empty cart
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>

<?php
$page_title = 'Make an Order';
include ('includes/header.php');
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
<div class="row">

    <div class="col-md-8">
    <?php
require_once "cartandpayment/product-list.php";
?>
    </div>


<div id="shopping-cart" class="col-md-4">
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
        <div class="align-right">
            <a href="process-checkout.php" class="btn btn-success">Go To Checkout</a>
        </div>
        <?php
    } // End if !empty $cartItem
    ?>

</div>

</div>

<div style="min-height:150px;"></div>

<?php
include ('includes/footer.html');
?>
<script>

    highlightNavItem('nav-item', 'nav-order');


</script>
</body>
</html>

