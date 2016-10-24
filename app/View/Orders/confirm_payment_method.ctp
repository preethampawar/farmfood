<div class="page-header">
	<h4>Confirm Payment Method</h4>
</div>

<div style="display:none;" id="orderUserErrorDiv" class="alert">	
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
				<textarea name="user[message]" id="UserMessage" class="form-control input-sm" placeholder="Enter your message..." maxlength="255"><?php echo $user_payment_details['User']['message'];?></textarea>
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				&nbsp;
			</div>
			<div class="col-sm-6">
				<button type="button" class="btn btn-primary btn-sm" onclick="submitOrderPaymentMethodForm()">Order Now</button>
			</div>
			
		</div>
	</div>
	<br>
	<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
</form>	