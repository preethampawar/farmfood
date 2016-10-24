Booking Confirmation.

Thank you for placing order with us. Your order has been booked.


Below are your order details:

Name: <?php echo $order_details['Order']['name'];?>
Mobile: <?php echo $order_details['Order']['mobile'];?>
Email: <?php echo $order_details['Order']['email'];?>
Address: <?php echo $order_details['Order']['address'];?>
Delivery Location: <?php echo $order_details['Order']['location'];?>
Payment Method: <?php echo ($order_details['Order']['payment_method'] == 'cod') ? 'Cash On Delivery' : $order_details['Order']['payment_method'];?>
Message: <?php echo $order_details['Order']['message'];?>

<?php
if(!empty($cart_items)) {
?>
Product details:

	<?php 
	$i = 0;
	foreach ($cart_items['ShoppingCartProduct'] as $row) {
		$shopping_cart_product_id = $row['id'];
		$product_id = $row['Product']['id'];
		$product_name = $row['Product']['name'];
		$product_qty = $row['quantity'];
		$i++; 
	?>
<?php echo $i;?>. <?php echo $product_name;?>
Quantity: <?php echo $product_qty;?>
Unit Price: Rs.<?php echo $row['Product']['selling_price'];?>			
Amount: Rs.<?php echo $product_qty*$row['Product']['selling_price'];?>

	<?php 
	}
	?>

Total item(s) = <?php echo $i;?>
Total Qty = <?php echo $qty_count;?>
Total Amount = Rs.<?php echo $total_amount;?>

Visit Farm Food Website at http://www.farmfood.in

In case if you have any questions or queries please mail to us at support@farmfood.in

Happy Shopping!!

-
Team Farm Food

Note* : This is a system generated message and please do not respond to this email.
<?php
}
?>
