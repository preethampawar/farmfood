<div class="page-header">
	<h4>Product List</h4>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-default">						
			<div class="panel-heading">
				<b>Category</b> 
			</div>			
			<div class="panel-body">
				<?php
				$selected_category = 'All';
				$selected_category_id = null;
				if(!empty($categories)) {
				?>
				<table class="table table-condensed table-striped">					
					<tbody>
					<?php
					foreach($categories as $row) {
					?>
						<tr>
							<td>
								<?php
									$hide_msg = "Are you sure you want to hide this category? Doing so will hide all the products related to it.\n\n".$row['Category']['name'];
									$show_msg = "Are you sure you want to show this category? Doing so will show all the products related to it.\n\n".$row['Category']['name'];
									if($row['Category']['active']) {
										echo $this->Html->link('<span class="status-circle-green" title="Active. Click to hide."></span>', '/categories/admin_change_status/'.$row['Category']['id'].'/hide', array('escape'=>false, 'confirm'=>$hide_msg));
									} else {
										echo $this->Html->link('<span class="status-circle-red" title="Inactive. Click to show."></span>', '/categories/admin_change_status/'.$row['Category']['id'].'/show', array('escape'=>false, 'confirm'=>$show_msg));							
									}
									echo ' &nbsp;';
									
									$class = "";
									if($row['Category']['id'] == $categoryID) {
										$selected_category = $row['Category']['name'];
										$selected_category_id = $row['Category']['id'];
										$class = "text-danger text-bold text-large";
									}
									echo $this->Html->link($row['Category']['name'], '/products/admin_list/'.$row['Category']['id'], array('class'=>$class));									
								?>
							</td>
							<td style="width:30px;">
								
								<?php 
								$category_id = $row['Category']['id'];
								$categoryName = $row['Category']['name'];
								
								echo $this->Html->link('<span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#adminEditCategoryModal" title="Edit - '.$row['Category']['name'].'"></span>', '#', array('escape'=>false, 'onclick'=>"updateCategoryEditForm('$category_id', '$categoryName')"));?>
								<!--
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<?php
								$confirm_msg = "Are you sure you want to delete this category?\n\n".$row['Category']['name'];
								echo $this->Html->link('<span class="glyphicon glyphicon-remove-circle text-danger" title="Edit"></span>', '/categories/admin_edit/'.$row['Category']['id'], array('escape'=>false, 'confirm'=>$confirm_msg));
								?>
								-->								
							</td>
						</tr>
					<?php	
					}
					?>
					</tbody>
					<tfoot></tfoot>
				</table>
				<?php
				}
				?>
			</div>
			<div class="panel-footer text-center">
				<a href="#" data-toggle="modal" data-target="#adminAddCategoryModal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create New Category</a>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Products List - <span class="text-danger"><?php echo $selected_category;?></spann></b>
			</div>
			
			<div class="panel-body">
				<p><a href="/products/admin_add/<?php echo $selected_category_id;?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add New Product </a></p>
				<?php
				if(!empty($products)) {
				?>
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							<th style="width:5px;">No.</th>
							<th>Product Name</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach($products as $row) {
						$i++;
					?>
						<tr>
							<td class="text-center"><?php echo $i;?></td>
							<td>
								
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-picture text-orange" title="Manage images"></span>', '/products/admin_images/'.$row['Product']['id'], array('escape'=>false));?>
								&nbsp;
								<?php //echo $this->Html->link('<span class="glyphicon glyphicon-pencil" title="Edit - '.$row['Product']['name'].'"></span>', '/products/admin_edit/'.$row['Product']['id'], array('escape'=>false));?>
								
								<?php
								$hide_msg = "Are you sure you want to hide this product?\n\n".$row['Product']['name'];
								$show_msg = "Are you sure you want to show this product?\n\n".$row['Product']['name'];
								if($row['Product']['active']) {
									echo $this->Html->link('<span class="status-circle-green" title="Active. Click to hide."></span>', '/products/admin_change_status/'.$row['Product']['id'].'/hide', array('escape'=>false, 'confirm'=>$hide_msg));
								} else {
									echo $this->Html->link('<span class="status-circle-red" title="Inactive. Click to show."></span>', '/products/admin_change_status/'.$row['Product']['id'].'/show', array('escape'=>false, 'confirm'=>$show_msg));							
								}
								?>
								&nbsp;
								<?php echo $this->Html->link($row['Product']['name'], '/products/admin_edit/'.$row['Product']['id'], array('escape'=>true));?>
								<!--
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<?php
								$confirm_msg = "Are you sure you want to delete this product?\n\n".$row['Product']['name'];
								echo $this->Html->link('<span class="glyphicon glyphicon-remove-circle text-danger" title="Edit"></span>', '/products/admin_edit/'.$row['Product']['id'], array('escape'=>false, 'confirm'=>$confirm_msg));
								?>						
								-->
							</td>
						</tr>
					<?php	
					}	
					?>
					</tbody>
					<tfoot></tfoot>
				</table>
				<?php
				} else {
				?>					
				No products found.
				<?php				
				}
				?>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
.row {
    margin-bottom: 10px;
}
</style>