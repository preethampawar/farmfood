<p><a href="/products/admin_list/<?php echo $categoryID;?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Back to Products List</a></p>

<div class="page-header">
	<h4>Add New Product</h4>
</div>
<div class="row">
	<div class="col-sm-12">
		<form id="newProductForm" method="post">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductCategoryId">Category</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.category_id', array('type'=>'select', 'class'=>'form-control input-sm', 'options'=>$categories_list, 'div'=>false, 'label'=>false, 'default'=>$categoryID));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductName">Product Name <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.name', array('type'=>'text', 'class'=>'form-control input-sm', 'placeholder'=>'Enter product name...', 'required'=>'required', 'maxlength'=>'55', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductDescription">Description<span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.description', array('type'=>'textarea', 'class'=>'summernote', 'placeholder'=>'Enter product description...', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductWeight">Weight (in grams)</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.weight', array('type'=>'number', 'class'=>'form-control input-sm', 'placeholder'=>'Enter product weight in grams...', 'min'=>'0', 'max'=>'9999999', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductMaxRetailPrice">Max Retail Price</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.max_retail_price', array('type'=>'number', 'class'=>'form-control input-sm', 'placeholder'=>'Enter Max Retail Price...', 'min'=>'0', 'max'=>'9999999', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductSellingPrice">Selling Price</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.selling_price', array('type'=>'number', 'class'=>'form-control input-sm', 'placeholder'=>'Enter Selling Price...', 'min'=>'0', 'max'=>'9999999', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductPriority">Priority (required for sorting)</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.priority', array('type'=>'number', 'class'=>'form-control input-sm', 'placeholder'=>'Enter number. 1 being the highest priority.', 'min'=>'0', 'max'=>'100', 'div'=>false, 'label'=>false, 'default'=>'1'));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductMetaKeywords">Meta Keywords</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.meta_keywords', array('type'=>'text', 'class'=>'form-control input-sm', 'placeholder'=>'Max 10 keywords...', 'maxlength'=>'150', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="ProductMetaDescription">Meta Description</label>
					</div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.meta_description', array('type'=>'text', 'class'=>'form-control input-sm', 'placeholder'=>'Max 255 chars...', 'maxlength'=>'255', 'div'=>false, 'label'=>false));?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.in_stock', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>'1'));?>
						<label for="ProductInStock">In Stock</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">
						<?php echo $this->Form->input('Product.featured', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>'1'));?>
						<label for="ProductFeatured">Featured (display on Home page)</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 text-left">
						<?php echo $this->Form->input('Product.active', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>'1'));?>
						<label for="ProductActive"> Is Active (Show/Hide product)</label>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<div class="row">						
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary btn-sm" id="submitButtonNewProductForm"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create Product</button>
						</div>
					</div>
				</div>
				<br>
				<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
			</div>
		</form>
	</div>
</div>
<style type="text/css">
.row {
    margin-bottom: 10px;
}
</style>