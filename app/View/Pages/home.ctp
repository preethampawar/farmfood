<?php
App::uses('Product', 'Model');
$this->ProductModel = new Product;
$products = $this->ProductModel->getFeaturedProducts();
?>
<p>Farm food is a weekly and monthly online food grains ordering service that connects you to Indian farms and food producers, allowing you to buy a wide range of seasonal, Indian food grains each week and every month at very low prices without compromising on the quality of the grains.</p>

<?php
if(!empty($products)) {
?>
<div class="page-header">
	<h1>Popular Products</h1>
	<!-- <p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p> -->
</div>

<!-- show products -->

<div class="row">
	<?php 
	$i=0;
	foreach($products as $row)
	{ 
		$i++;
		$product_id = $row['Product']['id'];
		$product_name = $row['Product']['name'];
		$product_instock = $row['Product']['in_stock'];
	?>
	<div class="col-xs-12 col-sm-6 col-lg-4"> 
		<div class="panel panel-default">						
			<div class="panel-heading">
				<a href="/products/show/<?php echo $product_id;?>"><b><?php echo $product_name;?></b></a>
			</div>
			<div class="panel-body" style="height:220px;">							
				<div class="row table-condensed">
					<div class="col-xs-5" style="padding-right:0;">						
						<?php echo $this->element('show_product_widget_image', array('product'=>$row));?>
					</div>
					<div class="col-xs-7">
						<?php echo $this->element('show_product_widget_price', array('product'=>$row['Product']));?>
						<?php 
						if($product_instock) {
							echo $this->element('show_product_widget_buy_now', array('product'=>$row['Product']));
						} else {
							echo $this->element('show_product_widget_out_of_stock');
						}
						?>
					</div>
				</div>
				<a href="/products/show/<?php echo $product_id;?>">more details...</a>	
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<?php
}
?>