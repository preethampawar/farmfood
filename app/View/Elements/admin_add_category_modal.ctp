<!-- Modal Admin Add Category -->
<div id="adminAddCategoryModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Category</h4>
			</div>
			<div class="modal-body">
				<form id="adminAddCategoryForm" method="post" action="/categories/admin_add">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="CategoryName">Category Name <span class="text-danger">*</span></label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="data[Category][name]" id="CategoryName" class="form-control input-sm" placeholder="Enter category name..." required="required" maxlength="55">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								&nbsp;
							</div>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary btn-sm" id="submitButtonAdminAddCategoryForm">Submit</button>
							</div>
							
						</div>
					</div>
				</form>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" id="cancelButtonContactModal">Cancel <span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>
	</div>
</div>