<!-- show cart products -->
<div class="page-header">
	<h4>Shopping Cart Items</h4>
</div>
<div class="row">
	<div class="col-md-6">
		<?php
		if(!empty($cart_items) and ($qty_count>0)) {
		?>
		<table class="table table-condensed table-striped">	
			<thead>
				<tr>
					
					<th>Name</th>
					<th style="width:10px;">Qty</th>
					<th style="width:85px;">Unit Price</th>
					<th style="width:85px;">Amount</th>
					<th style="width:70px;"></th>
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
					<td>
						<?php
						echo $this->Html->link('<span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#updateProductQtyInCartModal" title="Update quantity - '.$product_name.'"></span>', '#', array('escape'=>false, 'onclick'=>"showUpdateProductQtyInCart('$shopping_cart_product_id', '$product_qty', '$product_name')"));
						?>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<?php
						$confirm_msg = "Are you sure you want to remove this product?\n\n".$product_name;
						echo $this->Html->link('<span class="glyphicon glyphicon-remove-circle text-danger" title="Remove"></span>', '/shopping_carts/remove/'.$shopping_cart_product_id, array('escape'=>false, 'confirm'=>$confirm_msg));
						?>
					</td>
				</tr>
				<?php 
				}
				?>
				<tr>
					<td colspan="3" class="text-right">
						Total Amount = 
					</td>
					<td>Rs.<?php echo $total_amount;?></td>
					<td>&nbsp;</td>
				</tr>
				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5" class="text-left">
						Total item(s) = <?php echo $i;?><br>
						Total Qty = <?php echo $qty_count;?><br> 
						<b>Total Amount = Rs.<?php echo $total_amount;?></b> 
						<br><br>
						<a href="/orders/confirmUserDetails" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Place Order</a> <br><br>(or) <a href="/">Continue shopping...</a> 
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
<br><br>