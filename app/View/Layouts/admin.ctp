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
	
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">	
	<!-- Bootstrap theme -->
    <link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/theme.css" rel="stylesheet">
	
	<!-- Summernote - wysiwyg editor css --> 
	<link href="/summernote/summernote.css" rel="stylesheet">	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.min.js"></script>
      <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
		body {
			padding-top: 50px;
			padding-bottom: 30px; 
		}
	</style>
	
	
  </head>
  <body>
	<?php echo $this->element('admin_top_nav');?>
	<br>
	<div class="container theme-showcase" role="main">	
		<?php
		// load all the modal popups
		echo $this->element('admin_add_category_modal');	
		echo $this->element('admin_edit_category_modal');	
		?>
		
		<?php 
		echo $this->Session->flash();
		// show content
		echo $this->fetch('content'); 
		?>
	</div>
    
	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="/summernote/summernote.min.js"></script>
	
	<!-- load common admin js functions --> 
    <script src="/js/admin.js"></script>
	<?php echo $this->element('js_functions');?>
	
	<script type="text/javascript">
		$(function() {
		  $('.summernote').summernote({
			height: 200
		  });

		  $('form').on('submit', function (e) {
			/*
			e.preventDefault();
			alert($('.summernote').summernote('code'));
			alert($('.summernote').val());
			*/
			return true;
		  });
		});
	</script>
	
  </body>
</html>