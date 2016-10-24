function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function isMobile(mobile) {
	var regex = /^([0-9]){10}$/;
	return regex.test(mobile);
}

function updateCategoryEditForm(categoryID, categoryName) {
	console.log(categoryID);
	console.log(categoryName);
	
	$('#adminEditCategoryModal #modalTitle').html('Edit Category - '+categoryName);
	$('#adminEditCategoryModal #adminAddCategoryForm').attr('action', '/categories/admin_edit/'+categoryID);
	$('#adminEditCategoryModal #CategoryId').attr('value', categoryID);
	$('#adminEditCategoryModal #CategoryName').attr('value', categoryName);
}
