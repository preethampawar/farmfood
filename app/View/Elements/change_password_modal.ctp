<!-- Change Password Modal -->
<div id="changePasswordModal" class="modal fade" role="dialog">
	<div class="modal-dialog  modal-body-scroll">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			<div class="modal-body">
				<form>					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="UserOldPassword">Old Password <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-8">
								<input type="password" name="user[old_password]" id="UserOldPassword" class="form-control input-sm" placeholder="Enter your old password..." required="required" maxlength="55" pattern=".{4,55}" title="Password should contain minimum 4 characters">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="UserNewPassword">New Password <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-8">
								<input type="password" name="user[new_password]" id="UserNewPassword" class="form-control input-sm" placeholder="Enter your new password..." required="required" maxlength="55" pattern=".{4,55}" title="Password should contain minimum 4 characters">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4" style="padding-right:10px;">
								<label for="UserConfirmPassword">Re-enter Password <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-8">
								<input type="password" name="user[confirm_password]" id="UserConfirmPassword" class="form-control input-sm" placeholder="Confirm your password..." required="required" maxlength="55">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4" style="padding-right:10px;"></div>
							<div class="col-sm-8">
								<button type="button" id="changePasswordSubmit" class="btn btn-primary btn-sm" onclick="changePassword()">Submit</button>
								<img src="/img/loading.gif" alt="processing..." height="25" width="25" id="changePasswordLoadingImg" style="display:none;">
							</div>	
						</div>
					</div>
					<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
				</form>					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" id="cancelButtonChangePasswordModal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>
	