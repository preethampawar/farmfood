<!-- Modal Contact Us -->
<div id="contactModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Contact us</h4>
			</div>
			<div class="modal-body">				
				<div>
					<p>Get in touch with us. Below are our contact details.</p>
					
					<p><b>Support Team</b></p>
					<p><b>E:</b> <a href="mailto:support@gmail.com">support@gmail.com</a></p>
					<p><b>M:</b> +91 9494203060</p>
					<!--
					<p>
						<b>Address:</b>
						<address>
							#3950, Vidyut Nagar, 
							Tellapur, Dist. Medak, 
							Telangana - 502032
						</address>
					</p>
					-->
					<div class="page-header">
						<h4>Send us a message</h4>
					</div>
					<form id="contactModalForm">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-3">
									<label for="UserName">Full Name <span class="text-danger">*</span></label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="user[name]" id="UserName" class="form-control input-sm" placeholder="Enter your full name..." required="required" maxlength="55">
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-3">
									<label for="UserEmail">Email Address </label>
								</div>
								<div class="col-sm-9">
									<input type="email" name="user[email]" id="UserEmail" class="form-control input-sm" placeholder="Enter your email address..." maxlength="55">
								</div>
								
							</div>
						</div>	
						<div class="form-group">
							<div class="row">
								<div class="col-sm-3">
									<label for="UserMobile">Mobile </label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-sm">
										<span class="input-group-addon" id="mobile-addon">+91</span>
										<input type="text" class="form-control input-sm" id="UserMobile" aria-describedby="mobile-addon" placeholder="Enter your 10 digit mobile number..." pattern="[0-9]{10,10}" title=" Mobile number must contain 10 digits only, without spaces (ex: 9988223344)">
									</div>
								</div>
								
							</div>	
						</div>		
						<div class="form-group">
							<div class="row">
								<div class="col-sm-3">
									<label for="UserEmail">Message <span class="text-danger">*</span></label>
								</div>
								<div class="col-sm-9">
									<textarea name="user[message]" id="UserMessage" class="form-control input-sm" placeholder="Enter your message here..." required="required" maxlength="500"></textarea>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-3">
									&nbsp;
								</div>
								<div class="col-sm-9">
									<button type="button" class="btn btn-primary btn-sm" id="submitButtonContactModalForm" onclick="sendContactMessage()">Send Message</button>
									<img src="/img/loading.gif" alt="processing..." height="25" width="25" id="loadingImgContactModalForm" style="display:none;">
								</div>
								
							</div>
						</div>
						<br>
						<p><b>Note:</b> All fields marked as <span class="text-danger">*</span> are mandatory fields.</p>
					</form>	
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" id="cancelButtonContactModal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>	