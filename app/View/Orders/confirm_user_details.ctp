<?php 
if($showForm) {
	// get deliver locations
	App::uses('DeliveryLocation', 'Model');
	$this->DeliveryLocation = new DeliveryLocation;
	$locations = $this->DeliveryLocation->getFreeActiveLocations();

	$select_options = null;
	if(!empty($locations)) {
		foreach($locations as $row) {
			$selected = null;			
			$select_options[] = '<option value="'.$row['DeliveryLocation']['id'].'" '.$selected.'>'.$row['DeliveryLocation']['name'].'</option>';		
		}	
		$select_options = implode(' ', $select_options);	
	}
?>
<div style="display:none;" id="orderUserErrorDiv" class="alert"></div>
<div id="userDetailsDiv">
	<div class="page-header">
		<h4>Confirm User details</h4>
	</div>
	
	<form id="orderUserForm">
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					<label for="UserName">Full Name<span class="text-danger">*</span></label>
				</div>
				<div class="col-sm-6">
					<input type="text" name="user[name]" id="UserName" class="form-control input-sm" placeholder="Enter your full name..." required="required" maxlength="55" value="<?php echo $user_details['User']['name'];?>">
				</div>
				
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					<label for="UserMobile">Mobile<span class="text-danger">*</span></label>
				</div>
				<div class="col-sm-6">
					<div class="input-group input-group-sm">
						<span class="input-group-addon" id="mobile-addon">+91</span>
						<input type="text" class="form-control input-sm" id="UserMobile" aria-describedby="mobile-addon" placeholder="Enter your 10 digit mobile number..." pattern="[0-9]{10,10}" title=" Mobile number must contain 10 digits only, without spaces (ex: 9988223344)" required  value="<?php echo $user_details['User']['mobile'];?>">
					</div>
				</div>
				
			</div>	
		</div>	
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					<label for="UserEmail">Email Address<span class="text-danger">*</span></label>
				</div>
				<div class="col-sm-6">
					<input type="email" name="user[email]" id="UserEmail" class="form-control input-sm" placeholder="Enter your email address..." maxlength="55"  value="<?php echo $user_details['User']['email'];?>">
				</div>
				
			</div>
		</div>	
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					&nbsp;
				</div>
				<div class="col-sm-6">
					<button type="button" class="btn btn-primary btn-sm" id="submitButtonContactModalForm" onclick="submitOrderUserForm()">Next - Confirm address &nbsp; <span class="glyphicon glyphicon-arrow-right"></span></button>
				</div>
				
			</div>
		</div>
		<br>
		<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
	</form>					

</div>

<div id="userAddressDiv" style="display:block;">		
	<button type="button" class="btn btn-default btn-sm" onclick="$('#userDetailsDiv').show(); $('#userAddressDiv').hide(); $('#userPaymentDiv').hide();"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp; Back - User details</button>
		
	
	<div class="page-header">
		<h4>Confirm Address</h4>
	</div>
	<form id="orderAddressForm">
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					<label for="UserAddress">Address <span class="text-danger">*</span></label>
				</div>
				<div class="col-sm-6">
					<textarea name="user[address]" id="UserAddress" class="form-control input-sm" placeholder="Enter your address..." required="required" maxlength="255"></textarea>
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
					<button type="button" class="btn btn-primary btn-sm" onclick="submitOrderAddressForm()">Next - Confirm Payment &nbsp; <span class="glyphicon glyphicon-arrow-right"></span></button>
				</div>
				
			</div>
		</div>
		<br>
		<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
	</form>	
</div>

<div id="userPaymentDiv" style="display:block;">		
	<button type="button" class="btn btn-default btn-sm" onclick="$('#userPaymentDiv').hide(); $('#userAddressDiv').show(); $('#userDetailsDiv').hide();"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp; Back - Confirm address</button>
	
	<div class="page-header">
		<h4>Confirm Payment Method</h4>
	</div>
	<form id="orderPaymentMethodForm">	
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					<label for="UserPaymentMethod">Select Payment Method <span class="text-danger">*</span></label>
				</div>
				<div class="col-sm-6">
					<div class="input-group input-group-sm">
						<select name="user[payment_method]" id="UserPaymentMethod" class="form-control input-sm">
							<option value="cod">Cash On Delivery</option>
						</select>
					</div>
				</div>			
			</div>	
		</div>	
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					<label for="UserMessage">Message</label>
				</div>
				<div class="col-sm-6">
					<textarea name="user[message]" id="UserMessage" class="form-control input-sm" placeholder="Enter your message..." maxlength="255"></textarea>
				</div>
				
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-3">
					&nbsp;
				</div>
				<div class="col-sm-6">
					<button onclick="submitOrderPaymentMethodForm()" class="btn btn-success btn-sm" type="button">Order Now &nbsp; <span class="glyphicon glyphicon-check"></span></button>
				</div>
				
			</div>
		</div>
		<br>
		<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
	</form>	
	<form action="/orders/saveOrderDetails" method="post" id="saveOrderDetailsForm">
		<input type="hidden" name="Order[name]" id="OrderName">
		<input type="hidden" name="Order[email]" id="OrderEmail">
		<input type="hidden" name="Order[mobile]" id="OrderMobile">
		<input type="hidden" name="Order[delivery_location_id]" id="OrderDeliveryLocationId">
		<input type="hidden" name="Order[address]" id="OrderAddress">
		<input type="hidden" name="Order[payment_method]" id="OrderPaymentMethod">
		<input type="hidden" name="Order[message]" id="OrderMessage">
	</form>
</div>

<?php
} else {
?>

<div>
	<p><a href="#" data-toggle="modal" data-target="#signinModal" class="btn btn-primary">Sign in!</a> </p>
	<p>(or)</p> 
	<p><a href="/orders/confirmUserDetails/guest" class="btn btn-default">Continue as a guest...</a></p>
</div>

<?php
}
?>