<?php # Script 3.4 - index.php
include ('../includes/session.php');

$page_title = 'Register';
include ('../includes/header.php');

require_once("dbcontroller.php");

$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6" id="shopping-cart">
<h3>Shopping Cart</h3>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>
    <div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
<tr>
<th >Name</th>
<th >Code</th>
<th style="text-align:right;">Quantity</th>
<th  style="text-align:right;">Price</th>
<th ></th>
</tr>
    </thead>
    <tbody>
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td><?php echo $item["name"]; ?></td>
				<td ><?php echo $item["code"]; ?></td>
				<td  style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$".$item["price"]; ?></td>
				<td ><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><i class="fas fa-trash-alt"></i></a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
    <td colspan="4" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td><td></td>
</tr>
</tbody>
</table>
    </div>
<div style="text-align:center;"> <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>cd</div>
    <?php
}
?>
</div>
<!-- end shopping cart LEFT SIDE -->

<div  class="col-xs-12 col-sm-12 col-md-8 col-lg-6" id="product-grid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Choose from these tasty meals</h3>
        </div>
        <div class="panel-body">
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="col-xs-12 col-md-3">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div style="text-align:center;"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div style="text-align:center;"><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
			<div  style="text-align:right;"><?php echo "$".$product_array[$key]["price"]; ?></div>
                <div>
                    <label>qty</label></label>
                    <input class="form-control" type="text" name="quantity" value="1" size="2" />
                    <input type="submit" value="Add to cart" class="btn btn-success" />
                </div>
			</form>
		</div>
	<?php
			}
	}
	?>
        </div> <!-- end panel body -->

    </div> <!-- end Panel -->

</div> <!-- End Right side Product List -->

</div> <!-- End Row -->
<?php
include ('../includes/footer.html');
?>