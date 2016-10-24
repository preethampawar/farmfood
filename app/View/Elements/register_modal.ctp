<!-- Register Modal -->
<div id="registerModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Register with us</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="UserName">Full Name <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="user[name]" id="UserName" class="form-control input-sm" placeholder="Enter your full name. Min 3 chars..." required="required" maxlength="55">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="UserEmail">Email Address <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-9">
								<input type="email" name="user[email]" id="UserEmail" class="form-control input-sm" placeholder="Enter your email address..." required="required" maxlength="55">
							</div>
						</div>
					</div>	
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="UserMobile">Mobile <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-9">
								<div class="input-group input-group-sm">
									<span class="input-group-addon" id="mobile-addon">+91</span>
									<input type="text" class="form-control input-sm" id="UserMobile" aria-describedby="mobile-addon" placeholder="Enter your 10 digit mobile number..." required="required" pattern="[0-9]{10,10}" title=" Mobile number must contain 10 digits only, without spaces (ex: 9988223344)">
								</div>
							</div>
						</div>	
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="UserPassword">Password <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-9">
								<input type="password" name="user[password]" id="UserPassword" class="form-control input-sm" placeholder="Min 4+ chars..." required="required" maxlength="55" pattern=".{4,55}" title="Password should contain minimum 4 characters">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<button type="button" id="registerSubmit" class="btn btn-primary btn-sm" onclick="userRegister()">Submit</button>
						<img src="/img/loading.gif" alt="processing..." height="25" width="25" id="registerLoadingImg" style="display:none;">
							</div>
						</div>
					</div>
					
					<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
				</form>					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>
	