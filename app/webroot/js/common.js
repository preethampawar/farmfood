function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function isMobile(mobile) {
	var regex = /^([0-9]){10}$/;
	return regex.test(mobile);
}

function userRegister()
{
	var userName = $('#registerModal #UserName').val().trim();
	var userEmail = $('#registerModal #UserEmail').val().trim();
	var userMobile = $('#registerModal #UserMobile').val().trim();
	var userPassword = $('#registerModal #UserPassword').val();	
	
	// form validation
	var error = false;
	
	if(userName.length < 1) {
		var error = true;
		alert('Full name cannot be empty');
		$('#registerModal #UserName').focus();
	} else if((userName.length < 3) || (userName.length > 55)) {
		var error = true;
		alert('Full name should be 3 to 55 chars in length');
		$('#registerModal #UserName').focus();		
	}
	
	else if(userEmail.length == 0) {
		var error = true;
		alert('Email address cannot be empty');
		$('#registerModal #UserEmail').focus();
	} else if((userEmail.length < 3) || (userEmail.length > 55)) {
		var error = true;
		alert('Email address should be 3 to 55 chars in length');		
		$('#registerModal #UserEmail').focus();
	} else if(!isEmail(userEmail)) {
		var error = true;
		alert('Email address is not valid');		
		$('#registerModal #UserEmail').focus();
	}
	
	else if(userMobile.length < 1) {
		var error = true;
		alert('Mobile number cannot be empty');
		$('#registerModal #UserMobile').focus();
	} else if(!isMobile(userMobile)) {
		var error = true;
		alert('Mobile number should contain 10 digits. Only numbers are allowed');		
		$('#registerModal #UserMobile').focus();
	}
	
	else if(userPassword.length < 1) {
		var error = true;
		alert('Password field cannot be empty');
		$('#registerModal #UserPassword').focus();
	} else if((userPassword.length < 4) || (userPassword.length > 55)) {
		var error = true;
		alert('Password should be 4 to 55 chars in length');
		$('#registerModal #UserPassword').focus();		
	}	
	
	
	if(error == false) {
		$('#registerSubmit').hide();
		$('#registerLoadingImg').show();
		
		var register = $.ajax({
			url: "/users/add",
			method: "POST",
			data: { 'User[name]' : userName, 'User[email]' : userEmail, 'User[mobile]' : userMobile, 'User[password]' : userPassword},
			dataType: "json"
		});	 
		register.done(function( data ) {
			if( data.response.status == 'error' ) {
				alert(data.response.message);
				
				$('#registerSubmit').show();
				$('#registerLoadingImg').hide();
			} else {
				alert(data.response.message);
				document.location.reload(true);			
			}
		});	 
		register.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
			
			$('#registerSubmit').show();
			$('#registerLoadingImg').hide();
		});
	}
}

function userLogin()
{	 
	var userEmail = $('#signinModal #UserEmail').val().trim();
	var userPassword = $('#signinModal #UserPassword').val();
	
	// form validation
	var error = false;
	
	if(userEmail.length == 0) {
		var error = true;
		alert('Email address cannot be empty');
		$('#signinModal #UserEmail').focus();
	} else if((userEmail.length < 3) || (userEmail.length > 55)) {
		var error = true;
		alert('Email address should be 3 to 55 chars in length');		
		$('#signinModal #UserEmail').focus();
	} else if(!isEmail(userEmail)) {
		var error = true;
		alert('Email address is not valid');		
		$('#signinModal #UserEmail').focus();
	}
	
	else if(userPassword.length < 1) {
		var error = true;
		alert('Password field cannot be empty');
		$('#signinModal #UserPassword').focus();
	} else if((userPassword.length < 4) || (userPassword.length > 55)) {
		var error = true;
		alert('Password should be 4 to 55 chars in length');
		$('#signinModal #UserPassword').focus();		
	}
	
	if(error == false) {
		$('#signinSubmit').hide();
		$('#signinLoadingImg').show();
		
		var login = $.ajax({
			url: "/users/login",
			method: "POST",
			data: { 'User[email]' : userEmail, 'User[password]' : userPassword },
			dataType: "json"
		});	 
		login.done(function( data ) {
			if( data.response.status == 'error' ) {
				showAlertPopup('alert', data.response.message);
				
				$('#signinSubmit').show();
				$('#signinLoadingImg').hide();
			} else {
				console.log(data.response.data.redirect_url);
				showAlertPopup('alert', data.response.message);
				window.location.href = data.response.data.redirect_url;
				//document.location.reload(true);			
			}
		});	 
		login.fail(function( jqXHR, textStatus ) {
			showAlertPopup('alert', data.response.message);
			
			$('#signinSubmit').show();
			$('#signinLoadingImg').hide();
		});
	}
}

function sendResetPasswordLink()
{
	var userEmail = $('#forgotPasswordModal #UserEmail').val().trim();
	
	// form validation
	var error = false;
	
	if(userEmail.length == 0) {
		var error = true;
		alert('Email address cannot be empty');
		$('#signinModal #UserEmail').focus();
	} else if((userEmail.length < 3) || (userEmail.length > 55)) {
		var error = true;
		alert('Email address should be 3 to 55 chars in length');		
		$('#signinModal #UserEmail').focus();
	} else if(!isEmail(userEmail)) {
		var error = true;
		alert('Email address is not valid');		
		$('#signinModal #UserEmail').focus();
	}
	
	if(error == false) {
		$('#forgotPasswordSubmit').hide();
		$('#forgotPasswordLoadingImg').show();
		
		var login = $.ajax({
			url: "/users/sendPasswordResetLink",
			method: "POST",
			data: { 'User[email]' : userEmail },
			dataType: "json"
		});	 
		login.done(function( data ) {
			if( data.response.status == 'error' ) {
				alert(data.response.message);
				
				$('#forgotPasswordSubmit').show();
				$('#forgotPasswordLoadingImg').hide();
			} else {
				alert(data.response.message);
				document.location.reload(true);			
			}
		});	 
		login.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
			
			$('#forgotPasswordSubmit').show();
			$('#forgotPasswordLoadingImg').hide();
		});
	}
}

function sendContactMessage()
{
	var userName = $('#contactModalForm #UserName').val().trim();
	var userEmail = $('#contactModalForm #UserEmail').val().trim();
	var userMobile = $('#contactModalForm #UserMobile').val().trim();
	var userMessage = $('#contactModalForm #UserMessage').val().trim();
	
	// form validation
	var error = false;
	
	if(userName.length < 1) {
		var error = true;
		alert('Full name cannot be empty');
		$('#contactModalForm #UserName').focus();
	} else if((userName.length < 3) || (userName.length > 55)) {
		var error = true;
		alert('Full name should be 3 to 55 chars in length');
		$('#contactModalForm #UserName').focus();		
	}
	
	else if((userEmail.length == 0) && (userMobile.length == 0)) {
		var error = true;
		alert('Email address or Mobile number should be entered');
		$('#contactModalForm #UserEmail').focus();
	}
	
	else if((userEmail.length > 0) && ((userEmail.length < 3) || (userEmail.length > 55))) {
		var error = true;
		alert('Email address should be 3 to 55 chars in length');		
		$('#contactModalForm #UserEmail').focus();
	} else if((userEmail.length > 0) && (!isEmail(userEmail))) {
		var error = true;
		alert('Email address is not valid');		
		$('#contactModalForm #UserEmail').focus();
	}
	
	else if((userMobile.length > 0) && (!isMobile(userMobile))) {
		var error = true;
		alert('Mobile number should contain 10 digits. Only numbers are allowed');		
		$('#contactModalForm #UserMobile').focus();		
	}
	
	else if(userMessage.length == 0) {
		var error = true;
		alert('Message field cannot be empty');
		$('#contactModalForm #UserMessage').focus();
	} else if((userMessage.length < 5) || (userMessage.length > 500)) {
		var error = true;
		alert('Message should contain minimum 5 and maximum 500 chars');
		$('#contactModalForm #UserMessage').focus();
	}
	
	if(error == false) {
		$('#submitButtonContactModalForm').hide();
		$('#loadingImgContactModalForm').show();
		
		var contactMessage = $.ajax({
			url: "/users/contact",
			method: "POST",
			data: { 'Message[from_name]' : userName, 'Message[from_email]' : userEmail, 'Message[from_mobile]' : userMobile, 'Message[message]' : userMessage },
			dataType: "json"
		});	 
		contactMessage.done(function( data ) {
			$('#submitButtonContactModalForm').show();
			$('#loadingImgContactModalForm').hide();
			
			if( data.response.status == 'error' ) {				
				alert(data.response.message);
			} else {
				alert(data.response.message);
				$('#cancelButtonContactModal').click();
			}
		});	 
		contactMessage.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
			
			$('#submitButtonContactModalForm').show();
			$('#loadingImgContactModalForm').hide();
		});
	}
}

function changePassword()
{
	var userOldPassword = $('#changePasswordModal #UserOldPassword').val();
	var userNewPassword = $('#changePasswordModal #UserNewPassword').val();
	var userConfirmPassword = $('#changePasswordModal #UserConfirmPassword').val();	
	
	// form validation
	var error = false;
	
	
	if(userOldPassword.length < 1) {
		var error = true;
		alert('Old Password field cannot be empty');
		$('#changePasswordModal #UserOldPassword').focus();
	} else if((userOldPassword.length < 4) || (userOldPassword.length > 55)) {
		var error = true;
		alert('Old Password should be 4 to 55 chars in length');
		$('#changePasswordModal #UserOldPassword').focus();		
	}
	
	else if(userNewPassword.length < 1) {
		var error = true;
		alert('New Password field cannot be empty');
		$('#changePasswordModal #UserNewPassword').focus();
	} else if((userNewPassword.length < 4) || (userNewPassword.length > 55)) {
		var error = true;
		alert('New Password should be 4 to 55 chars in length');
		$('#changePasswordModal #UserNewPassword').focus();		
	}
	
	else if(userNewPassword != userConfirmPassword) {
		var error = true;
		alert('New Password and Re-enter Password field values do not match');
		$('#changePasswordModal #UserConfirmPassword').focus();
	}
	
	if(error == false) {
		$('#changePasswordSubmit').hide();
		$('#changePasswordLoadingImg').show();
		
		var register = $.ajax({
			url: "/users/changePassword",
			method: "POST",
			data: { 'User[old_password]' : userOldPassword, 'User[new_password]' : userNewPassword, 'User[confirm_password]' : userConfirmPassword},
			dataType: "json"
		});	 
		register.done(function( data ) {
			$('#changePasswordSubmit').show();
			$('#changePasswordLoadingImg').hide();

			if( data.response.status == 'error' ) {
				alert(data.response.message);				
			} else {
				alert(data.response.message);
				$('#cancelButtonChangePasswordModal').click();
			}
		});	 
		register.fail(function( jqXHR, textStatus ) {
			$('#changePasswordSubmit').show();
			$('#changePasswordLoadingImg').hide();

			alert( "Request failed: " + textStatus );			
		});
	}
}

function addToCart(product_id, buynow='')
{	 
	var quantity = $('#qty'+product_id).val();
	var error = false;
	if(quantity < 1) {
		var error = true;
		alert('Quantity should be greater than or equal to 1.');
		$('#qty'+product_id).focus();
	} 
	
	if(error == false) {
		showAlertPopup('processing');
		
		var cart = $.ajax({
			url: "/shopping_carts/add",
			method: "POST",
			data: { 'ShoppingCartProduct[product_id]' : product_id, 'ShoppingCartProduct[quantity]' : quantity },
			dataType: "json"
		});	 
		cart.done(function( data ) {			
			if( data.response.status == 'error' ) {
				alertMessage(data.response.message);				
			} else {
				if(buynow == 'buynow') {
					window.location.href = '/shopping_carts/show';
				} else {				
					alertMessage(data.response.message);
					
					$('#qty'+product_id).val(1);
					
					var cart_items_count = data.response.data.cart_items_count;
					var cart_qty_count = data.response.data.cart_qty_count;
					var total_qty = ' ('+cart_qty_count+')';
					
					
					$('#topNavCartIcon').addClass('text-orange');
					$('#topNavCartItemsCount').addClass('btn-warning');
					
					$("#topNavCartLink").attr('title', cart_items_count+' item(s) in cart. Total quantity = '+cart_qty_count);
					$("#topNavCartItemsCount").html(cart_items_count + total_qty);
				}
				// $("#topNavCartLink").fadeTo('slow', 0.5).fadeTo('slow', 1.0)
									// .fadeTo('slow', 0.5).fadeTo('slow', 1.0)
									// .fadeTo('slow', 0.5).fadeTo('slow', 1.0);
				//document.location.reload(true);			
			}
			alertAutoClose(3);
		});	 
		cart.fail(function( jqXHR, textStatus ) {			
			alertMessage( "Request failed: " + textStatus );
		});
	}
}

function showUpdateProductQtyInCart(shopping_cart_product_id, product_qty, product_name)
{	 
	$('#updateProductQtyInCartModal #shoppingCartProductId').val(shopping_cart_product_id);
	$('#updateProductQtyInCartModal #quantity').val(product_qty);
	$('#updateProductQtyInCartModal #product-title').html(product_name);	
}

function updateProductQtyInCart()
{	 
	var shopping_cart_product_id = $('#updateProductQtyInCartModal #shoppingCartProductId').val();
	var quantity = $('#updateProductQtyInCartModal #quantity').val();
	
	var error = false;
	
	if(shopping_cart_product_id < 1) {
		var error = true;
		showAlertPopup('alert', 'Error! Please refresh the page and try again.');
	}
	
	if(quantity < 1) {
		var error = true;
		showAlertPopup('alert', 'Quantity should be greater than or equal to 1.');
		$('#quantity').focus();
	} 
	
	if(error == false) {
		showAlertPopup('processing');
		
		var cart = $.ajax({
			url: "/shopping_carts/updateQuantity",
			method: "POST",
			data: { 'ShoppingCartProduct[id]' : shopping_cart_product_id, 'ShoppingCartProduct[quantity]' : quantity },
			dataType: "json"
		});	 
		cart.done(function( data ) {			
			if( data.response.status == 'error' ) {
				alertMessage(data.response.message);				
			} else {
				alertMessage(data.response.message);
				document.location.reload(true);			
			}
		});	 
		cart.fail(function( jqXHR, textStatus ) {			
			alertMessage( "Request failed: " + textStatus );
		});
	}
}

function showAlertPopup(type, message='')
{
	$('#alertModal #processingDiv').hide();
	$('#alertModal #alertMessageDiv').hide();
	
	if(type=='processing') {
		$('#alertModal').modal({'backdrop': 'static'});
		$('#alertModal').modal('show');
		$('#alertModal #processingDiv').show();
	}
	if(type=='alert') {
		$('#alertModal').modal({'backdrop': true});
		$('#alertModal').modal('show');
		$('#alertModal #alertMessage').html(message);
		$('#alertModal #alertMessageDiv').show();
	}
}

function alertMessage(message)
{
	$('#alertModal #processingDiv').hide();
	$('#alertModal #alertMessage').html(message);
	$('#alertMessageDiv').show();
}

function alertAutoClose(seconds=1)
{
	var delay_time = 1000 * seconds;
	setTimeout(function() {
		$('#alertModal').modal('hide');
	}, delay_time);
}

function submitOrderUserForm()
{
	var userName = $('#orderUserForm #UserName').val().trim();
	var userEmail = $('#orderUserForm #UserEmail').val().trim();
	var userMobile = $('#orderUserForm #UserMobile').val().trim();
	
	// hide error/success message
	$('#orderUserErrorDiv').hide();
	$('#orderUserErrorDiv').removeClass('alert-danger');
	$('#orderUserErrorDiv').removeClass('alert-success');
	
	// form validation
	var error = false;
	
	if(userName.length < 1) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Full name cannot be empty.');
		$('#orderUserForm #UserName').focus();
	} else if((userName.length < 3) || (userName.length > 55)) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Full name should be 3 to 55 chars in length.');
		$('#orderUserForm #UserName').focus();		
	}
	
	else if(userMobile.length == 0) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Mobile number is required.');
		$('#orderUserForm #UserMobile').focus();
	}
	
	else if(userEmail.length == 0) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Email address is required.');
		$('#orderUserForm #UserEmail').focus();
	}	
	else if((userEmail.length < 3) || (userEmail.length > 55)) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Email address should be 3 to 55 chars in length.');		
		$('#orderUserForm #UserEmail').focus();
	} else if((userEmail.length > 0) && (!isEmail(userEmail))) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Email address is not valid.');		
		$('#orderUserForm #UserEmail').focus();
	}
	
	else if((userMobile.length > 0) && (!isMobile(userMobile))) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Mobile number should contain 10 digits. Only numbers are allowed.');		
		$('#orderUserForm #UserMobile').focus();		
	}
	
	if(error == false) {		
		var orderUserDetailsRequest = $.ajax({
			url: "/orders/saveUserDetails",
			method: "POST",
			data: { 'Order[name]' : userName, 'Order[email]' : userEmail, 'Order[mobile]' : userMobile },
			dataType: "json"
		});	 
		orderUserDetailsRequest.done(function( data ) {
			
			if( data.response.status == 'error' ) {
				$('#orderUserErrorDiv').addClass('alert-danger');	
				$('#orderUserErrorDiv').show();
				$('#orderUserErrorDiv').html(data.response.message);
			} else {				
				window.location.href = '/orders/confirmAddress';
			}
		});	 
		orderUserDetailsRequest.fail(function( jqXHR, textStatus ) {
			$('#orderUserErrorDiv').html( "Request failed: " + textStatus );
			$('#orderUserErrorDiv').addClass('alert-danger');
			$('#orderUserErrorDiv').show();
		});
	} else {
		$('#orderUserErrorDiv').addClass('alert-danger');
		$('#orderUserErrorDiv').show();
	}
}

function submitOrderAddressForm()
{
	var userAddress = $('#orderAddressForm #UserAddress').val().trim();
	var userLocationId = $('#orderAddressForm #UserLocation').val().trim();
	
	// hide error/success message
	$('#orderUserErrorDiv').hide();
	$('#orderUserErrorDiv').removeClass('alert-danger');
	$('#orderUserErrorDiv').removeClass('alert-success');
	
	// form validation
	var error = false;
	
	if(userAddress.length < 1) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Address cannot be empty.');
		$('#orderAddressForm #UserAddress').focus();
	} else if((userAddress.length < 3) || (userAddress.length > 255)) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Address should be 3 to 255 chars in length.');
		$('#orderAddressForm #UserAddress').focus();		
	}
	
	else if(userLocationId.length == 0) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Location is required.');
		$('#orderAddressForm #UserLocation').focus();
	}
	
	if(error == false) {		
		var orderAddressRequest = $.ajax({
			url: "/orders/saveAddress",
			method: "POST",
			data: { 'Order[address]' : userAddress, 'Order[delivery_location_id]' : userLocationId },
			dataType: "json"
		});	 
		orderAddressRequest.done(function( data ) {
			
			if( data.response.status == 'error' ) {
				$('#orderUserErrorDiv').addClass('alert-danger');	
				$('#orderUserErrorDiv').show();
				$('#orderUserErrorDiv').html(data.response.message);
			} else {				
				window.location.href = '/orders/confirmPaymentMethod';
			}
		});	 
		orderAddressRequest.fail(function( jqXHR, textStatus ) {
			$('#orderUserErrorDiv').html( "Request failed: " + textStatus );
			$('#orderUserErrorDiv').addClass('alert-danger');
			$('#orderUserErrorDiv').show();
		});
	} else {
		$('#orderUserErrorDiv').addClass('alert-danger');
		$('#orderUserErrorDiv').show();
	}
}

function submitOrderPaymentMethodForm()
{
	var userPaymentMethod = $('#orderPaymentMethodForm #UserPaymentMethod').val().trim();
	var userMessage = $('#orderPaymentMethodForm #UserMessage').val().trim();
	
	// hide error/success message
	$('#orderUserErrorDiv').hide();
	$('#orderUserErrorDiv').removeClass('alert-danger');
	$('#orderUserErrorDiv').removeClass('alert-success');
	
	// form validation
	var error = false;
	
	if(userPaymentMethod != 'cod') {
		var error = true;
		$('#orderUserErrorDiv').html('Error! Select Payment Method');
		$('#orderPaymentMethodForm #UserPaymentMethod').focus();
	}
	
	if(error == false) {		
		var orderPaymentMethodRequest = $.ajax({
			url: "/orders/savePaymentDetails",
			method: "POST",
			data: { 'Order[payment_method]' : userPaymentMethod, 'Order[message]' : userMessage },
			dataType: "json"
		});	 
		orderPaymentMethodRequest.done(function( data ) {
			
			if( data.response.status == 'error' ) {
				$('#orderUserErrorDiv').addClass('alert-danger');	
				$('#orderUserErrorDiv').show();
				$('#orderUserErrorDiv').html(data.response.message);
			} else {
				window.location.href = '/orders/bookOrder';
			}
		});	 
		orderPaymentMethodRequest.fail(function( jqXHR, textStatus ) {
			$('#orderUserErrorDiv').html( "Request failed: " + textStatus );
			$('#orderUserErrorDiv').addClass('alert-danger');
			$('#orderUserErrorDiv').show();
		});
	} else {
		$('#orderUserErrorDiv').addClass('alert-danger');
		$('#orderUserErrorDiv').show();
	}
}

function verifyOTP()
{
	var userOTP = $('#orderConfirmForm #UserOTP').val().trim();
	
	// hide error/success message
	$('#orderUserErrorDiv').hide();
	$('#orderUserErrorDiv').removeClass('alert-danger');
	$('#orderUserErrorDiv').removeClass('alert-success');
	
	// form validation
	var error = false;
	
	if(userOTP.length < 1) {
		var error = true;
		$('#orderUserErrorDiv').html('Error! OTP field cannot be empty.');
		$('#orderAddressForm #UserOTP').focus();
	}
	
	if(error == false) {		
		var orderVerifyOTPRequest = $.ajax({
			url: "/orders/verifyotp",
			method: "POST",
			data: { 'otp' : userOTP },
			dataType: "json"
		});	 
		orderVerifyOTPRequest.done(function( data ) {
			
			if( data.response.status == 'error' ) {
				$('#orderUserErrorDiv').addClass('alert-danger');	
				$('#orderUserErrorDiv').show();
				$('#orderUserErrorDiv').html(data.response.message);
			} else {				
				window.location.href = '/orders/confirmOrder';
			}
		});	 
		orderVerifyOTPRequest.fail(function( jqXHR, textStatus ) {
			$('#orderUserErrorDiv').html( "Request failed: " + textStatus );
			$('#orderUserErrorDiv').addClass('alert-danger');
			$('#orderUserErrorDiv').show();
		});
	} else {
		$('#orderUserErrorDiv').addClass('alert-danger');
		$('#orderUserErrorDiv').show();
	}
}
