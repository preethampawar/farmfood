<!-- Fixed navbar -->
<nav class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand active" href="/">Farm Food</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li><a href="/pages/about">About</a></li>
			<li><a href="#" data-toggle="modal" data-target="#contactModal">Contact</a></li>
			<!--
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li role="separator" class="divider"></li>
					<li class="dropdown-header">Nav header</li>
					<li><a href="#">Separated link</a></li>
					<li><a href="#">One more separated link</a></li>
				</ul>
			</li>
			<li><a href="#register" data-toggle="modal" data-target="#registerModal">Register</a></li> 
			-->
			<?php
			if($this->Session->check('User.name')) {
			?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My account <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header"><?php echo $this->Session->read('User.name');?>
							<?php if($this->Session->read('User.admin') == true) { ?>						
								<a href="/users/admin">Admin Panel</a>
							<?php } ?>
						</li>						
						<li role="separator" class="divider"></li>
						<li><a href="#">Edit Profile</a></li>
						<li><a href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">My Orders</a></li>
					</ul>
				</li>
				
				<li><a href="/users/logout">Log out</a></li>
			<?php		
			} else {
			?>
				<li><a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Register</a></li>
				<li><a href="#signinModal" data-toggle="modal" data-target="#signinModal">Sign in!</a></li>
			<?php
			}
			?>
		  </ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="50">
	<div class="container">
		<div class="subnav">
			<!-- <a href="/" title="Home page"><span class="glyphicon glyphicon-home"></span></a> &nbsp; | &nbsp; -->
			<a href="#" title="Show products list" data-toggle="modal" data-target="#productsModal"><span class="glyphicon glyphicon-th" style="font-size:18px; top:3px;"></span> <span class="small">Shop by Category</span></a> &nbsp; | &nbsp;
			<?php
			App::uses('ShoppingCart', 'Model');
			$this->ShoppingCart = new ShoppingCart;
			$items_count = $this->ShoppingCart->getProductsCountInCart($this->Session->read('ShoppingCart.id'));
			$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($this->Session->read('ShoppingCart.id'));
			$total_qty = null;
			if($items_count > 0) {
				$total_qty = ' ('.$qty_count.')';
				$orangeTextClass="text-orange";
				$orangeBackground="btn-warning";
			} else {				
				$orangeTextClass="";
				$orangeBackground="";
			}
			?>
			<a href="/shopping_carts/show" title="<?php echo $items_count;?> - item(s) in cart. Total quantity = <?php echo $qty_count;?>" id="topNavCartLink">
				<span class="glyphicon glyphicon-shopping-cart <?php echo $orangeTextClass;?>" style="font-size:18px; top:3px;" id="topNavCartIcon"></span> 
				<span class="small badge <?php echo $orangeBackground;?>" style="font-size:11px;" id="topNavCartItemsCount">
					<?php echo $items_count.$total_qty;?>
				</span>
			</a>
		</div>
	</div>
</nav>