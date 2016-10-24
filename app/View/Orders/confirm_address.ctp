<?php
App::uses('DeliveryLocation', 'Model');
$this->DeliveryLocation = new DeliveryLocation;
$locations = $this->DeliveryLocation->getFreeActiveLocations();

$select_options = null;
$selected_location_id = $user_address['User']['delivery_location_id'];

if(!empty($locations)) {
	foreach($locations as $row) {
		$selected = null;
		if($selected_location_id == $row['DeliveryLocation']['id']) {
			$selected = 'selected';
		}
		
		$select_options[] = '<option value="'.$row['DeliveryLocation']['id'].'" '.$selected.'>'.$row['DeliveryLocation']['name'].'</option>';		
	}	
	$select_options = implode(' ', $select_options);	
}
?>

<div class="page-header">
	<h4>Confirm Address</h4>
</div>

<div style="display:none;" id="orderUserErrorDiv" class="alert">	
</div>
<form id="orderAddressForm">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="UserAddress">Address <span class="text-danger">*</span></label>
			</div>
			<div class="col-sm-6">
				<textarea name="user[address]" id="UserAddress" class="form-control input-sm" placeholder="Enter your address..." required="required" maxlength="255"><?php echo $user_address['User']['address'];?></textarea>
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="UserLocation">Select Location</label>
			</div>
			<div class="col-sm-6">
				<div class="input-group input-group-sm">
					<select name="user[location]" id="UserLocation" class="form-control input-sm">
					<?php echo $select_options;?>
					</select>
				</div>
			</div>
			
		</div>	
	</div>	
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				&nbsp;
			</div>
			<div class="col-sm-6">
				<button type="button" class="btn btn-primary btn-sm" onclick="submitOrderAddressForm()">Next &nbsp; <span class="glyphicon glyphicon-arrow-right"></span></button>
			</div>
			
		</div>
	</div>
	<br>
	<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
</form>	