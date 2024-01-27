 <div class="sub_banner">
		<img src="<?php echo base_url(); ?>assets/images/fashion.png" class="img-responsive">
	
        </div>

<div class="container">
<?php if(empty($products)) { ?><h2> Products not found. Please try with other keyword.</h2>
<?php } else { ?> 
<section>		
<div class="container">			
<div class="row">				
<?php $this->load->view('includes/front/leftsidebar');?>				
<div class="col-sm-9 padding-right">              
<h2 class="title text-center">Search Products</h2>									
<?php if(!empty($products)) { 	foreach($products as $prod) {	
									if($prod['cost']==$prod['p_d_price']){$discount="";}
									else{$disc=$prod['cost']-$prod['p_d_price'];		
									$discount="<p class='disc'>".round($disc/$prod['cost']*100) ."% OFF </p>";}				
									if($prod['cost']==$prod['p_d_price']){$procost="";}else{$procost="<span> Rs. ".$prod['cost']."</span>";}						
									echo ' <div class="col-sm-4">
							<a href="'.base_url().'divino-product/'.$prod['p_id'].'">									
									<div class="product-image-wrapper">	
									
									<div class="single-products">						
									<div class="productinfo text-center">';																			
									if($prod['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }		    
									else { echo '<img src="'.base_url().'main-admin/images/product/'.$prod['image'].'" class="img-responsive">'; }											
									echo'									<h2>Rs. '.$prod['p_d_price'].'</h2>											
									<p>'.$prod['pname'].'</p>			
									<!--<p>Pro ID: '.$prod['sku'].'</p>	-->
									<a href="'.base_url().'divino-product/'.$prod['p_id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>										</div>										<!--div class="product-overlay">											<div class="overlay-content">												<h2>RS 56</h2>												<p>Easy Polo Black Edition</p>												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>											</div>										</div-->								</div>								
									<!--div class="choose">									<ul class="nav nav-pills nav-justified">										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>									</ul>
									</div-->							
									</div>						</div>						';				
									}
									} ?>							
									</div>			
									</div>		
									</div>	
									</section>						
									<?php } /**************** endif category not found ******************/ ?>
									</div>