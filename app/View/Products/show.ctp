<?php
$category_id = $product_details['Category']['id'];
$category_name = $product_details['Category']['name'];

$product_id = $product_details['Product']['id'];
$product_name = $product_details['Product']['name'];
$product_desc = $product_details['Product']['description'];
$product_mrp = $product_details['Product']['max_retail_price'];
$product_sp = $product_details['Product']['selling_price'];
$product_instock = $product_details['Product']['in_stock'];
$product_weight = $product_details['Product']['weight'];

if($product_weight < 1000 ) {
	$product_weight_description =  $product_weight.' grams';
}
if($product_weight >= 1000 ) {
	$product_weight_description =  ($product_weight/1000).' Kg';
}
$product_price = ($product_details['Product']['selling_price'] > 0) ? $product_details['Product']['selling_price'] : $product_details['Product']['max_retail_price'];
?>	
	  
	  
<!-- show category products -->
<div class="row">
	<div class="col-md-8">
		<ol class="breadcrumb">			
			<li><a href="/products/showCategoryProducts/<?php echo $category_id;?>"><b><?php echo $category_name;?></b></a></li>
			<li class="active"><b><?php echo $product_name;?></b></li>
		</ol>
		
				<div class="panel panel-default">					
					<div class="panel-body">
						<div class="row">
							<?php
							if(!empty($product_details['Image'])) {
								foreach($product_details['Image'] as $row) {
									$imageID = $row['id'];
									$productName = ucwords($product_name);
									$productNameSlug = Inflector::slug($productName, '-');
									
									$imageUrl = $this->Html->url($this->Img->showImage('img/images/'.$imageID, array('height'=>'600','width'=>'600','type'=>'auto', 'quality'=>'90', 'filename'=>$productNameSlug), array('style'=>'', 'alt'=>$productName), true), true);
									$imageThumbUrl = $this->Html->url($this->Img->showImage('img/images/'.$imageID, array('height'=>'150','width'=>'150','type'=>'crop', 'quality'=>'90', 'filename'=>$productNameSlug), array('style'=>'', 'height'=>'150','width'=>'150', 'alt'=>$productName), true), true);	
									?>
									<div class="col-md-3 col-sm-4 col-xs-6 text-center">
										<a href="<?php echo $imageUrl;?>" data-lightbox="<?php echo $productNameSlug;?>"  data-title="<a href='<?php echo $imageUrl;?>'>View full image...</a>">
											<img src="<?php echo $imageThumbUrl;?>" alt="<?php echo $productName;?>" width='150' height='150' class='img-responsive img-thumbnail'>	
										</a>										
									</div>
									<?php
								}
							}
							?>
						</div>
						
						<h1><?php echo $product_name;?></h1>
						<div class="row">
							<div class="col-sm-7">
								<form>
									<div class="form-group">
										<p>
											<?php 
											if(($product_mrp > 0) and ($product_sp > 0)) {
											?>
												<span style="text-decoration: line-through;" class="text-grey">MRP: Rs.<?php echo $product_mrp;?></span> <br>
												
												<span class="text-red text-large text-bold">Our Price: Rs.<?php echo $product_sp;?></span>
												<span class="text-red text-italic small">(You save: Rs.<?php echo ($product_mrp-$product_sp);?>)</span>
												
												
											<?php
											} else {
											?>
												<span style="text-decoration: line-through;">Price: Rs.<?php echo $product_price;?></span>
											<?php	
											}
											?>
										</p>
										
										<?php 
										if($product_weight > 0) {
											echo '<p>Weight: '.$product_weight_description.'</p>'; 
										}
										?>
										
										<p>	
											<?php 
											if($product_instock > 0) 
											{
											?>	
												<label for="qty">Quantity:</label>
												<select class="form-control input-sm" id="qty<?php echo $product_id;?>" name="quantity" >
													<?php for($qtyCount=1; $qtyCount<=10; $qtyCount++) { ?>
													<option value="<?php echo $qtyCount;?>"><?php echo $qtyCount;?></option>
													<?php } ?>
												</select>
											<?php
											} else {
												echo '<h4 class="text-danger">This product is out of Stock</h4>';
											}
											?>
										</p>	
									</div>
									
									<?php 
									if($product_instock > 0) 
									{
									?>
										<div class="btn-group btn-group-justified" role="group" aria-label="...">
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-primary btn-sm" title="Buy Now" onclick="addToCart(<?php echo $product_id;?>, 'buynow')"><b><i>Buy Now</i></b></button>
											</div>
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-default btn-sm" title="Add to cart" onclick="addToCart(<?php echo $product_id;?>)">Add to Cart</button>
											</div>
										</div>
									<?php
									}
									?>									
								</form>
							</div>
							<div class="col-sm-5">
							</div>
						</div>
						<br>
						
						
						<?php echo $product_desc;?>
					</div>
				</div>
	</div>
	<div class="col-md-4">
		<?php echo $this->element('category_menu_sidebar', array('selected_category_id'=>$category_id));?>
	</div>
</div>
