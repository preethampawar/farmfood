<!-- Modal Forgot Password -->
<div id="forgotPasswordModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">				
			<div class="modal-header">
				<b>Forgot password?</b>
			</div>
			<div class="modal-body">
				<form>						
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">															
								<div class="input-group input-group-sm">
									<span class="input-group-addon" id="forgot-password-email-addon">Email Address</span> 
									<input type="email" name="user[email]" id="UserEmail" class="form-control input-sm" placeholder="Enter your email address..." required="required" maxlength="55" aria-describedby="forgot-password-email-addon">
								</div>
							</div>
						</div>							
						<div class="col-md-3">
							<div class="form-group">
								<button type="button" id="forgotPasswordSubmit" class="btn btn-primary btn-sm" onclick="sendResetPasswordLink()">Submit</button>
								<img src="/img/loading.gif" alt="processing..." height="25" width="25" id="forgotPasswordLoadingImg" style="display:none;">
							</div>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-12">
						
						<p><b>Note:</b> A confirmation link will be sent to your registered Email address. Please follow the instructions in the email to reset your password.</p>
						<p>
							<a href="#" data-toggle="modal" data-target="#signinModal" data-dismiss="modal">Sign in!</a>
							&nbsp;|&nbsp;
							<a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Register</a>
						</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>
	