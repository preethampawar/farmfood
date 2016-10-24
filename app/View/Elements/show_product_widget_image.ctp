<?php
$product_id = $product['Product']['id'];
$imageID = (isset($product['Image'][0]['id'])) ? $product['Image'][0]['id'] : null;
$categoryID = $product['Product']['category_id'];
$productName = $product['Product']['name'];
$productName = ucwords($productName);
$productNameSlug = Inflector::slug($productName, '-');
?>

<a href="/products/show/<?php echo $product_id;?>">
	<?php
	if($imageID) {							
		echo $this->Img->showImage('img/images/'.$imageID, array('height'=>'150','width'=>'150','type'=>'crop', 'quality'=>'90', 'filename'=>$productNameSlug), array('style'=>'', 'height'=>'150','width'=>'150', 'alt'=>$productName, 'id'=>'image'.$categoryID.'-'.$imageID, 'class'=>'img-responsive'));
	} else {
	?>							
	<img src="holder.js/120x120" class="img-responsive img-thumbnail">
	<?php
	}
	?>
</a>