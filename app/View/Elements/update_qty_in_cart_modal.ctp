<div id="updateProductQtyInCartModal" class="modal fade" role="dialog">
	<div class="modal-dialog  modal-body-scroll">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="product-title">Update Quantity</h4>
			</div>
			<div class="modal-body">
				<form id="updateCartForm" method="post" onsubmit="return false;">
					<div class="form-group">
						<div class="row">
							<div class="col-xs-3">
								<label for="quantity">Quantity<span class="text-danger">*</span></label>
							</div>
							<div class="col-xs-9">
								<input type="hidden" name="id" id="shoppingCartProductId">
								<input type="number" name="quantity" id="quantity" class="form-control input-sm" placeholder="Enter quantity. Min 1+" min="1" max="1000" required>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-xs-3"></div>
							<div class="col-xs-9">
								<button type="button" class="btn btn-primary btn-sm" title="Update" onclick="updateProductQtyInCart()"><b>Update</b></button>								
							</div>
						</div>
					</div>					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>	