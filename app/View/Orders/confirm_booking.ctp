<div class="page-header">
	<h4>Booking Confirmation</h4>
</div>
<div>Thank you for placing order with us. Your order has been booked.</div>
<br>
<p>Below are your order details:</p>
<div class="row">
	<div class="col-md-7">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td>Name</td>
					<td><?php echo $order_details['Order']['name'];?></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td><?php echo $order_details['Order']['mobile'];?></td>
				</tr>	
				<tr>
					<td>Email</td>
					<td><?php echo $order_details['Order']['email'];?></td>
				</tr>	
				<tr>
					<td>Address</td>
					<td><?php echo $order_details['Order']['address'];?></td>
				</tr>	
				<tr>
					<td>Delivery Location</td>
					<td><?php echo $order_details['Order']['location'];?></td>
				</tr>	
				<tr>
					<td>Payment Method</td>
					<td><?php echo ($order_details['Order']['payment_method'] == 'cod') ? 'Cash On Delivery' : $order_details['Order']['payment_method'];?></td>
				</tr>					
				<tr>
					<td>Message</td>
					<td><?php echo $order_details['Order']['message'];?></td>
				</tr>
			</tbody>
		</table>
		<?php
		if(!empty($cart_items)) {
		?>
		<table class="table table-striped table-bordered">	
			<thead>
				<tr>					
					<th>Product Name</th>
					<th style="width:10px;">Qty</th>
					<th style="width:100px;">Unit Price</th>
					<th style="width:100px;">Amount</th>
				</tr>
			</thead>			
			<tbody>
				<?php 
				$i = 0;
				foreach ($cart_items['ShoppingCartProduct'] as $row) {
					$shopping_cart_product_id = $row['id'];
					$product_id = $row['Product']['id'];
					$product_name = $row['Product']['name'];
					$product_qty = $row['quantity'];
					$i++; 
				?>
				<tr>
					
					<td><a href="/products/show/<?php echo $product_id;?>"><?php echo $product_name;?></a></td>
					<td><?php echo $product_qty;?></td>
					<td>Rs.<?php echo $row['Product']['selling_price'];?></td>					
					<td>Rs.<?php echo $product_qty*$row['Product']['selling_price'];?></td>					
				</tr>
				<?php 
				}
				?>
				<tr>
					<td colspan="3" class="text-right">
						Total Amount 
					</td>
					<td>Rs.<?php echo $total_amount;?></td>  
				</tr>
				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-left">
						Total item(s) = <?php echo $i;?><br>
						Total Qty = <?php echo $qty_count;?><br> 
						<b>Total Amount = Rs.<?php echo $total_amount;?></b>
					</td>
				</tr>
			</tfoot>
		</table>
		<?php
		} else {
			echo 'There are no products in your cart. <br><br><a href="/">Continue shopping...</a> ';			
		}
		?>
	</div>	
</div>
<br>

<p><a href="/">Continue shopping...</p>