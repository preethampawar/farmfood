<?php 
$product_sp = $product['selling_price'];
$product_mrp = $product['max_retail_price'];	
$product_price = ($product_sp > 0) ? $product_sp : $product_mrp;
?>
<p>
	<?php
	if(($product_mrp > 0) and ($product_sp > 0)) {
	?>
		<span style="text-decoration: line-through;">MRP: Rs.<?php echo $product_mrp;?></span> <br>
		<span class="text-red text-large text-bold">Our Price: Rs.<?php echo $product_sp;?></span> <br>
		<span class="text-italic small">(You save: Rs.<?php echo ($product_mrp-$product_sp);?>)</span>
	<?php
	} else {
	?>
		<span>Price: Rs.<?php echo $product_price;?></span> <br><br><br>
	<?php	
	}
	?>
</p>