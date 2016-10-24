<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/users/admin" title="Admin Panel" class="navbar-brand active">Admin Panel</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">Products</li>
						<li><a href="/products/admin_add"><span class="glyphicon glyphicon-plus"></span> Add New Product</a></li>
						<li><a href="/products/admin_list"><span class="glyphicon glyphicon-list"></span> List All Products</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Categories</li>
						<li><a href="#" data-toggle="modal" data-target="#adminAddCategoryModal"><span class="glyphicon glyphicon-plus"></span> Add New Category</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orders <span class="caret"></span></a>
					<ul class="dropdown-menu">						
						<li><a href="#"><span class="glyphicon glyphicon-list"></span> Orders List</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-plus"></span> New Order</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="/delivery_locations/admin_list"><span class="glyphicon glyphicon-list"></span> Delivery Locations List</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
					<ul class="dropdown-menu">						
						<li><a href="#"><span class="glyphicon glyphicon-list"></span> Users List</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-plus"></span> New User</a></li>
					</ul>
				</li>
				<li><a href="/users/logout">Log out</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>