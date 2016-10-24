<?php
$product_id = $product['id'];
?>
<form id="cartForm<?php echo $product_id;?>">
	<div class="form-group">												
		<label for="qty<?php echo $product_id;?>">Quantity:</label>
		<select class="form-control input-sm" id="qty<?php echo $product_id;?>" name="quantity" >
			<?php for($qtyCount=1; $qtyCount<=10; $qtyCount++) { ?>
			<option value="<?php echo $qtyCount;?>"><?php echo $qtyCount;?></option>
			<?php } ?>
		</select>
	</div>
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-primary btn-sm" title="Buy Now" onclick="addToCart(<?php echo $product_id;?>, 'buynow')" style="padding-left: 2px; padding-right:2px;"><b><i>Buy Now</i></b></button>
		</div>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm" title="Add to cart" onclick="addToCart(<?php echo $product_id;?>)" style="padding-left: 2px; padding-right:2px;">Add to Cart</button>
		</div>
	</div>					
</form>