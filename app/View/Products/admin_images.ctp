<a href="/products/admin_list/<?php echo $product_details['Product']['category_id'];?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Back to Products List</a>

<div class="page-header">
	<h4>Images: <?php echo $product_details['Product']['name'];?></h4>
</div>
<form method="post" action="/products/admin_upload_images/<?php echo $product_details['Product']['id'];?>" enctype="multipart/form-data">
	
	<div class="row">
		<div class="col-sm-2">
			<label for="ProductImages">Select Image(s)</label>
		</div>
		<div class="col-sm-4">
			<?php echo $this->Form->input('Product.images.', array('type'=>'file', 'class'=>'form-control input-sm', 'accept'=>'image/*', 'div'=>false, 'label'=>false, 'multiple'));?> <span class="small text-red">(Only 5 images are allowed per request)</span>
		</div>	
		<div class="col-sm-4">
			<button type="submit" class="btn btn-primary btn-sm" id="submitButtonNewProductForm"><span class="glyphicon glyphicon-upload"></span>&nbsp; Upload</button>
		</div>
	</div>
</form>

<div>
<?php
if(!empty($product_details['Image'])) {
	?>
	<br>
	<div class="row">
	<?php
	foreach($product_details['Image'] as $row) {
		$imageID = $row['id'];
		$productID = $product_details['Product']['id'];
		$categoryID = $product_details['Product']['category_id'];
		$productName = $product_details['Product']['name'];
		$productName = ucwords($productName);
		$productNameSlug = Inflector::slug($productName, '-');
		?>
		<div class="col-md-2 col-sm-3 col-xs-4 text-center">
			<?php echo $this->Img->showImage('img/images/'.$imageID, array('height'=>'150','width'=>'150','type'=>'crop', 'quality'=>'90', 'filename'=>$productNameSlug), array('style'=>'', 'height'=>'150','width'=>'150', 'alt'=>$productName, 'id'=>'image'.$categoryID.'-'.$imageID));?>
			<?php echo $this->Html->link('Delete', '/products/admin_deleteImage/'.$imageID, array('confirm'=>'Are you sure you want to delete this image?', 'class'=>'list-group-item'));?>
			<br><br>
		</div>
		<?php
	}
	?>
	</div>
	<?php
} else {
	echo 'No image(s) found.';
}
?>
</div>