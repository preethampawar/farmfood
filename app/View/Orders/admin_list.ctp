<div>
	<b>Show Orders:</b> 
	<a href="/orders/admin_list/booked">Booked</a> (<?php echo $booked_count;?>), 
	<a href="/orders/admin_list/confirmed">Confirmed</a> (<?php echo $confirmed_count;?>), 
	<a href="/orders/admin_list/delivered">Delivered</a> (<?php echo $delivered_count;?>), 
	<a href="/orders/admin_list/cancelled">Cancelled</a> (<?php echo $cancelled_count;?>), 
	<a href="/orders/admin_list/closed">Closed</a> (<?php echo $closed_count;?>), 
	<a href="/orders/admin_list/unknown">Unknown</a> (<?php echo $unknown_count;?>) 
</div>

<div class="page-header">
	<h4>Orders - <?php echo $status;?> (<?php echo count($orders);?>)</h4>
</div>
<?php
if(!empty($orders)) {
?>

<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>#</th>
			<th>Total Amount</th>
			<th>Status</th>
			<th>Customer</th>
			<th>Date (dd-mm-yyyy)</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$k = 1;
		foreach($orders as $row) {
			$order_status = $this->Order->getOrderStatus($row);
		?>
		<tr>
			<td><?php echo $this->Html->link($row['Order']['id'], '/orders/admin_order_details/'.$row['Order']['id'], array('title'=>'Order #'.$row['Order']['id'].'. Click for details.'));?></td>
			<td>Rs.<?php echo $row['Order']['total_amount'];?></td>
			<td><?php echo ucwords($order_status);?></td>
			<td><?php echo $row['Order']['name'];?></td>
			<td><?php echo date('d-m-Y', strtotime($row['Order']['transaction_date']));?></td>
			<td>
				<?php echo $this->Html->link('Edit', '/orders/admin_order_edit/'.$row['Order']['id'], array('title'=>'Edit Order #'.$row['Order']['id']));?>
			</td>
		</tr>
		<?php
			$k++;
		}
		?>
	</tbody>
	<tfoot></tfoot>
</table>

<?php	
} else {
	echo 'No orders found';
}
?>