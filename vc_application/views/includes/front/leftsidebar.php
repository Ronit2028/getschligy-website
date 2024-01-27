<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							
							
							<?php if(isset($category_list) && (!empty($category_list))) { 
	  
	foreach($category_list as $category) {
		echo '<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="'.base_url().'category/'.str_replace(' ','-',$category['c_name']).'">'.$category['c_name'].'</a></h4>
								</div>
							</div>';
	}
	
} ?>
							
						<div class="panel-heading">
									<h4 class="panel-title">
										<a href="/products">View All</a></h4>
								</div>
						</div><!--/category-products-->
						
						
					
						
						
						
						
						
					
					</div>
				</div>
				
