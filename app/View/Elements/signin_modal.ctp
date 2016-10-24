<!-- Modal Sign in! -->
<div id="signinModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">				
			<div class="modal-body">
				<form method="post" onsubmit="userLogin(); return false;">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">															
								<div class="input-group input-group-sm">
									<span class="input-group-addon" id="signin-email-addon">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<input type="email" name="user[email]" id="UserEmail" class="form-control input-sm" placeholder="Enter your email..." required="required" maxlength="55" aria-describedby="signin-email-addon">
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<div class="input-group input-group-sm">
									<span class="input-group-addon" id="signin-password-addon">Password</span>										
									<input type="password" name="user[password]" id="UserPassword" class="form-control input-sm" placeholder="Min 4+ chars..." required="required" maxlength="55" pattern=".{4,55}" title="Password should contain minimum 4 characters" aria-describedby="signin-password-addon">
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<button type="submit" id="signinSubmit" class="btn btn-primary btn-sm" onsubmit="userLogin(); return false;">Sign in</button>
								<img src="/img/loading.gif" alt="processing..." height="25" width="25" id="signinLoadingImg" style="display:none;">
							</div>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-12">
						<a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Register</a>
						&nbsp;|&nbsp;
						<a href="#" data-toggle="modal" data-target="#forgotPasswordModal" data-dismiss="modal">Forgot password?</a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>
	
