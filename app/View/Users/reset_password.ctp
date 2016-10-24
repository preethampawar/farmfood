<div class="page-header">
	<h1>Reset Password</h1>
</div>

<form id="passwordResetSubmit" method="post">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label for="UserPassword">New Password <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9">
						<input type="password" name="User[password]" id="UserPassword" class="form-control input-sm" placeholder="Enter your password..." required="required" maxlength="55" pattern=".{4,55}" title="Password should contain minimum 4 characters">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3" style="padding-right:10px;">
						<label for="UserConfirmPassword">Confirm Password <span class="text-danger">*</span></label>
					</div>
					<div class="col-sm-9">
						<input type="password" name="User[confirm_password]" id="UserConfirmPassword" class="form-control input-sm" placeholder="Confirm your password..." required="required" maxlength="55">
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" id="passwordResetSubmit" class="btn btn-primary btn-sm" onclick="validatePasswordResetForm()">Submit</button>
				<img src="/img/loading.gif" alt="processing..." height="25" width="25" id="registerLoadingImg" style="display:none;">
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</form>