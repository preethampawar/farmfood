<?php
//App::uses('Product', 'Model');
App::uses('Category', 'Model');
$this->CategoryModel = new Category;
$category_products = $this->CategoryModel->getAllActiveProducts();
?>

<!-- Modal Products -->
<div id="productsModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Shop By Category</h4>				
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<?php
						if(!empty($category_products)) 
						{
						?>
							<div class="list-group small">
								<a href="/products/showCategoryProducts" class="list-group-item space-left">-- Show all products --</a>
							</div>
							<?php	
							foreach($category_products as $category) 
							{
								$category_id = $category['Category']['id'];
								$category_name = $category['Category']['name'];
								?>
								<div class="list-group small">
									<a href="/products/showCategoryProducts/<?php echo $category_id;?>" class="list-group-item space-left active text-bold">
										<?php echo $category_name;?>
									</a>
									<?php
									if(!empty($category['Product'])) {
										foreach($category['Product'] as $product) {
											$product_id = $product['id'];
											$product_name = $product['name'];
											$product_mrp = $product['max_retail_price'];
											$product_sp = $product['selling_price'];
											$product_instock = $product['in_stock'];
											
											$price = ($product['selling_price'] > 0) ? $product['selling_price'] : $product['max_retail_price'];
											?>
											
											<a href="/products/show/<?php echo $product_id;?>"  class="list-group-item space-left">
												<?php echo $product_name;?>
												
												<?php
												if($product_instock == 0) {
												?>
												<span class="small text-italic text-red"> - No stock</span>
												<?php
												}
												?>
												
												<?php
												if($price > 0) {
												?>
													<span class="badge btn-info">Rs.<?php echo $price;?></span>
												<?php
												}
												?>
												
												<?php
												/*												
												if(($product_mrp > 0) and ($product_sp > 0)) {
												?>
													<span class="badge btn-warning">(Rs.<?php echo ($product_mrp-$product_sp);?> OFF)</span>
												<?php
												}	
												*/
												?>
											</a> 
											
											<?php
										}
									} else {
										echo '<span class="list-group-item space-left"> - No Product(s)</span>';
									}
									?>
								</div>
							<?php
							}							
						} else {
						?>
						- No products found.
						<?php
						}
						?>	
							
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>
	