 <div class="sub_banner">
		<img src="<?php echo base_url(); ?>assets/images/fashion.png" class="img-responsive">
	
        </div>

<section class="lam_products">
		<div class="container">
			<div class="row" style="margin:0px;"> 
				<div class="col-sm-12">
           
<?php 

if(!empty($products)) { 
	foreach($products as $prod) {
		
		
		if($prod['cost']==$prod['p_d_price']){$discount="";}else{$disc=$prod['cost']-$prod['p_d_price'];
		$discount="<p class='disc'>".round($disc/$prod['cost']*100) ."% OFF </p>";}
		
		if($prod['cost']==$prod['p_d_price']){$procost="";}else{$procost="<span> Rs. ".$prod['cost']."</span>";}
		
	  	 
	echo '<a href="'.base_url().'divino-product/'.$prod['p_id'].'"><div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products pro">
										<div class="productinfo productinfo1 text-center">';
										
											if($prod['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$prod['image'].'" class="img-responsive">'; }
											
		echo'										 
												<div class="product_hover">
												<p>'.$prod['pname'].'</p>
		                                         <p class="mrp">Rs. '.$prod['p_d_price'].'</p>
												 </div> 
										</div>
										
			                                
										
							</div>
						</div>
						</div></a>
						';	
	}
} ?>
</div>
</div>
</div>

</section>	