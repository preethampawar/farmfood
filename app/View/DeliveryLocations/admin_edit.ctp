<div class="page-header">
	<h4>Edit Location: <?php echo $delivery_location['DeliveryLocation']['name'];?></h4>
</div>
<form id="locationForm" method="post">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="LocationName">Location Name <span class="text-danger">*</span></label>
			</div>
			<div class="col-sm-6">
				<?php echo $this->Form->input('DeliveryLocation.name', array('type'=>'input', 'class'=>'form-control input-sm', 'div'=>false, 'label'=>false, 'default'=>$delivery_location['DeliveryLocation']['name'], 'placeholder'=>'Enter location name...', 'required'=>'required', 'maxlength'=>55));?>
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="LocationDeliveryTime">Delivery time <span class="text-danger">*</span></label>
			</div>
			<div class="col-sm-6">
				<?php echo $this->Form->input('DeliveryLocation.delivery_time', array('type'=>'input', 'class'=>'form-control input-sm', 'div'=>false, 'label'=>false, 'default'=>$delivery_location['DeliveryLocation']['delivery_time'], 'placeholder'=>'Enter delivery time...', 'required'=>'required', 'maxlength'=>55));?>
			</div>			
		</div>	
	</div>	
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 text-left">
			<?php echo $this->Form->input('DeliveryLocation.active', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>$delivery_location['DeliveryLocation']['active']));?>
			<label for="ProductActive"> Is Active (Show/Hide location)</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 text-left">
			<?php echo $this->Form->input('DeliveryLocation.free_delivery', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>$delivery_location['DeliveryLocation']['free_delivery']));?>
			<label for="ProductActive"> Free Delivery</label>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				&nbsp;
			</div>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-primary btn-sm" id="submitButtonContactModalForm">Update Location</button>
			</div>
			
		</div>
	</div>
</form>