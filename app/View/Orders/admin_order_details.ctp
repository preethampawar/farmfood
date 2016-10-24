<?php
echo $this->Html->link('Back to Orders list', '/orders/admin_list');
?>

<div class="page-header">
	<h4>Order Details: #<?php echo $order_details['Order']['id'];?></h4>
</div>
<?php
if(!empty($order_details)) {
	//debug($order_details); exit;
	$cart_items = $order_details['OrderProduct'];
?>
	<table class="table table-striped table-condensed">
		<tbody>
			<tr>
				<td style="max-width: 150px;">Order No.:</td>
				<td><?php echo $order_details['Order']['id'];?></td>
			</tr>
			<tr>
				<td>Order Date:</td>
				<td><?php echo date('d-m-Y', strtotime($order_details['Order']['transaction_date']));?></td>
			</tr>
			<tr>
				<td>Order Status:</td>
				<td>
					<?php 
					if($order_details['Order']['booked']) {
						echo 'Booked - on '. date('d-m-Y', strtotime($order_details['Order']['booked_date'])).'<br>';
						
						if($order_details['Order']['confirmed']) {
							echo 'Confirmed - on '. date('d-m-Y', strtotime($order_details['Order']['confirmed_date'])).'<br>';	
							
							if($order_details['Order']['delivered']) {
								echo 'Delivered - on '. date('d-m-Y', strtotime($order_details['Order']['delivery_date'])).'<br>';	
							}	
							if($order_details['Order']['cancelled']) {
								echo 'Cancelled - on '. date('d-m-Y', strtotime($order_details['Order']['cancelled_date'])).'<br>';	
							}
							
							if($order_details['Order']['closed']) {
								echo 'Closed - on '. date('d-m-Y', strtotime($order_details['Order']['closed_date'])).'<br>';	
							}
						}
						
					} else {
						echo 'Unknown';
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Promo Code:</td>
				<td><?php echo ($order_details['Order']['promo_code']) ? $order_details['Order']['promo_code'] : '-';?></td>
			</tr>
			<tr>
				<td>Discount:</td>
				<td>Rs.<?php echo $order_details['Order']['discount_amount'];?></td>
			</tr>
			<tr>
				<td>Total Amount:</td>
				<td>Rs.<?php echo $order_details['Order']['total_amount'];?> (after discount)</td>
			</tr>
		
			<tr>
				<td>Customer Name:</td>
				<td><?php echo $order_details['Order']['name'];?></td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td><?php echo $order_details['Order']['email'];?></td>
			</tr>
			<tr>
				<td>Mobile No.:</td>
				<td><?php echo $order_details['Order']['mobile'];?></td>
			</tr>
			<tr>
				<td>Message:</td>
				<td><?php echo $order_details['Order']['message'];?></td>
			</tr>
			<tr>
				<td>Payment Method:</td>
				<td><?php echo $order_details['Order']['payment_method'];?></td>
			</tr>
			<tr>
				<td>Delivery Time:</td>
				<td><?php echo $order_details['Order']['delivery_time'];?></td>
			</tr>
			<tr>
				<td>Delivery Location:</td>
				<td><?php echo $order_details['Order']['location'];?></td>
			</tr>
			<tr>
				<td>Delivery Address:</td>
				<td><pre><?php echo $order_details['Order']['address'];?></pre></td>
			</tr>
		</tbody>
	</table>
	<hr>
	<table class="table table-condensed table-striped">	
		<thead>
			<tr>
				<th style="width:20px;">#</th>
				<th>Product Name</th>
				<th style="width:20px;">Qty</th>
				<th style="width:100px;">Unit Price</th>
				<th style="width:100px;">Amount</th>				
			</tr>
		</thead>			
		<tbody>
			<?php 
			$i = 0;
			foreach ($cart_items as $row) {				
				$category_name = $row['category_name'];
				$product_name = $row['product_name'];
				$product_qty = $row['quantity'];
				$i++; 
			?>
			<tr>				
				<td><?php echo $i;?>.</td>
				<td><?php echo $product_name;?></td>
				<td><?php echo $product_qty;?></td>
				<td>Rs.<?php echo $row['selling_price'];?></td>
				<td>Rs.<?php echo $product_qty*$row['selling_price'];?></td>
				
			</tr>
			<?php 
			}
			?>
			<tr>
				<td colspan="4" class="text-right">
					Total Amount = 
				</td>
				<td>Rs.<?php echo $order_details['Order']['total_amount'];?></td>
			</tr>			
		</tbody>		
	</table>

<?php	
} else {
	echo 'No orders found';
}
?>