<?php 
if($showForm) {
?>
<div class="page-header">
	<h4>Confirm User details</h4>
</div>

<div style="display:none;" id="orderUserErrorDiv" class="alert">	
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
				<button type="button" class="btn btn-primary btn-sm" id="submitButtonContactModalForm" onclick="submitOrderUserForm()">Next &nbsp; <span class="glyphicon glyphicon-arrow-right"></span></button>
			</div>
			
		</div>
	</div>
	<br>
	<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
</form>					
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