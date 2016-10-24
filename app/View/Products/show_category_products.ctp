<?php
	if(!empty($category_details)) {	
		$category_id = $category_details['Category']['id'];
		$category_name = $category_details['Category']['name'];	
	} else {
		$category_id = null;
		$category_name = '-- Show all products --';
	}
	$i = 0;
?>

<!-- show category products -->

<div class="row">
	<div class="col-md-8">
		<ol class="breadcrumb">			
			<li class="text-bold">Category</li>
			<li><a href="/products/showCategoryProducts/<?php echo $category_id;?>"><b><?php echo $category_name;?></b></a></li>
		</ol>
		<?php
		if(!empty($category_products)) {
		?>
		<div class="row">
			<?php	
			foreach($category_products as $row) {
				$product = $row['Product'];
				
				$product_id = $product['id'];
				$product_name = $product['name'];
				$product_instock = $product['in_stock'];
				?>
				<div class="col-xs-12 col-sm-6 col-lg-6"> 
					<div class="panel panel-default">						
						<div class="panel-heading">
							<a href="/products/show/<?php echo $product_id;?>"><b><?php echo $product_name;?></b></a>
						</div>
						<div class="panel-body" style="height:220px;">							
							<div class="row">
								<div class="col-xs-5">
									<?php echo $this->element('show_product_widget_image', array('product'=>$row));?>
								</div>
								<div class="col-xs-7">
									<?php echo $this->element('show_product_widget_price', array('product'=>$product));?>
									<?php 
									if($product_instock) {
										echo $this->element('show_product_widget_buy_now', array('product'=>$product));
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
			<?php
			}			
			?>
		</div>
		<?php
		} else {
			echo '<p>&nbsp;&nbsp;&nbsp;&nbsp; - No product(s) found. </p>';
		}
		?>
	</div>
	<div class="col-md-4">
		<?php echo $this->element('category_menu_sidebar', array('selected_category_id'=>$category_id));?>
	</div>
</div>
