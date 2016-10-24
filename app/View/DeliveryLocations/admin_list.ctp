<div class="page-header">
	<h4>Add New Location</h4>
</div>
<form id="locationForm" action="/delivery_locations/admin_add" method="post">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="LocationName">Location Name <span class="text-danger">*</span></label>
			</div>
			<div class="col-sm-6">
				<input type="text" name="DeliveryLocation[name]" id="LocationName" class="form-control input-sm" placeholder="Enter location name..." required="required" maxlength="55">
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				<label for="LocationDeliveryTime">Delivery time <span class="text-danger">*</span></label>
			</div>
			<div class="col-sm-6">
				<input type="text" name="DeliveryLocation[delivery_time]" id="LocationDeliveryTime" class="form-control input-sm" placeholder="Enter delivery time..." required="required" maxlength="55">
			</div>			
		</div>	
	</div>	
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 text-left">
			<?php echo $this->Form->input('DeliveryLocation.active', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>'0'));?>
			<label for="ProductActive"> Is Active (Show/Hide location)</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 text-left">
			<?php echo $this->Form->input('DeliveryLocation.free_delivery', array('type'=>'checkbox', 'class'=>false, 'div'=>false, 'label'=>false, 'default'=>'0'));?>
			<label for="ProductActive"> Free Delivery</label>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-3">
				&nbsp;
			</div>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-primary btn-sm" id="submitButtonContactModalForm">Add New Location</button>
			</div>
			
		</div>
	</div>
</form>

<div class="page-header">
	<h4>Locations List</h4>
</div>
<?php 
if(!empty($delivery_locations)) {
?>
	<table class="table table-stripped">
		<thead>
			<tr>
				<th>Sl.No</th>
				<th>Name</th>
				<th>Time</th>
				<th>Status</th>
				<th>Free Delivery</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 0;
		foreach ($delivery_locations as $row) {
			$i++;
		?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['DeliveryLocation']['name'];?></td>
				<td><?php echo $row['DeliveryLocation']['delivery_time'];?></td>
				<td><?php echo ($row['DeliveryLocation']['active']) ? 'Active' : 'Inactive';?></td>
				<td><?php echo ($row['DeliveryLocation']['free_delivery']) ? 'Free' : '-';?></td>
				<td>
					<a href="/delivery_locations/admin_edit/<?php echo $row['DeliveryLocation']['id'];?>">Edit</a>
					&nbsp; | &nbsp;
					<?php
					$confirm_msg = "Are you sure you want to delete this location?\n\n".$row['DeliveryLocation']['name'];
					echo $this->Html->link('<span class="glyphicon glyphicon-remove-circle text-danger" title="Delete"></span>', '/delivery_locations/admin_delete/'.$row['DeliveryLocation']['id'], array('escape'=>false, 'confirm'=>$confirm_msg));
					?>
				</td>
			</tr>
		<?php	
		}
		?>
		<tbody>
	</table>
<?php		
} else {
?>
	- No locations found
<?php
}
?>

