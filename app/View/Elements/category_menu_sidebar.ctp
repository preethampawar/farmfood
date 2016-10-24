<?php
App::uses('Category', 'Model');
$this->CategoryModel = new Category;
$categories = $this->CategoryModel->find('all', array('conditions'=>array('Category.active'=>1), 'order'=>array('Category.name')));
?>

<div class="list-group small">					
	<div class="list-group-item btn-default">
		<b>Category Menu</b>
	</div>
	<?php
	if(!empty($categories)) 
	{
	?>
		
			<a href="/products/showCategoryProducts" class="list-group-item">-- Show all products --</a>
			<?php	
			foreach($categories as $row) {
				$category_id = $row['Category']['id'];
				$category_name = $row['Category']['name'];

				$class = "";
				if($selected_category_id == $category_id) {
					$class = 'active text-bold';
				}	
				?>
				
					<a href="/products/showCategoryProducts/<?php echo $category_id;?>" class="list-group-item <?php echo $class;?>">
						<?php echo $category_name;?>							
					</a>
				
				<?php
			}
			?>
		
		<?php
	} else {
		echo '<div class="list-group-item"> - No data found.</div>';
	}
	?>
	
</div>