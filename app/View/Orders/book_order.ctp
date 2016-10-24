<div class="page-header">
	<h4>Book Your Order</h4>
</div>

<div style="display:none;" id="orderUserErrorDiv" class="alert">	
</div>

<div class="alert alert-success">A new OTP has been generated and sent to your Mobile number.</div><br>
<form id="orderConfirmForm">			
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="UserMessage">Enter your OTP</label>
			</div>
			<div class="col-sm-6">
				<input type="text" name="user[otp]" id="UserOTP" class="form-control input-sm" placeholder="Enter your OTP..." maxlength="55">
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				&nbsp;
			</div>
			<div class="col-sm-6">
				<button type="button" class="btn btn-primary btn-sm" onclick="verifyOTP()">Next &nbsp; <span class="glyphicon glyphicon-arrow-right"></span></button>
			</div>
			
		</div>
	</div>
	<br>
	<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
</form>	