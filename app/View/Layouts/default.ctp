<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
    <meta name="author" content="Farm Food">
    <link rel="icon" href="/favicon.ico">
	
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">	
	<!-- Bootstrap theme -->
    <link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/theme.css" rel="stylesheet">
	<link href="/lightbox/dist/css/lightbox.css" rel="stylesheet">
	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.min.js"></script>
      <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<?php echo $this->element('top_nav');?>
	<br>
	<div class="container theme-showcase" role="main">
		<?php
		// load all the modal popups
		echo $this->element('signin_modal');	
		echo $this->element('contact_modal');	
		echo $this->element('change_password_modal');
		echo $this->element('forgot_password_modal');
		echo $this->element('register_modal');
		echo $this->element('products_modal');	
		echo $this->element('update_qty_in_cart_modal');
		echo $this->element('alert_modal');	
		?>
		
		<?php 
		echo $this->Session->flash();
		// show content
		echo $this->fetch('content'); 
		?>
		<a id="back-to-top" href="#" class="btn btn-warning back-to-top" role="button" title="Back to Top" data-toggle="tooltip" data-placement="top">
			<span class="glyphicon glyphicon-chevron-up"></span>
		</a>	
	</div>
    
	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
	
	<!-- common js functions --> 
    <script src="/js/common.js"></script>
    <script src="/lightbox/dist/js/lightbox.min.js"></script>
	<?php echo $this->element('js_functions');?>
	<script type="text/javascript">
    $(document).ready(function(){
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
					$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('#back-to-top').click(function () {
			$('#back-to-top').tooltip('hide');
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});			
		$('#back-to-top').tooltip('show');
	});
	</script>
  </body>
</html>