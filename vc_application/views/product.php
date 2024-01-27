<?php $prod = $products[0]; //print_r($products);   ?>
 <div class="sub_banner">
		<img src="<?php echo base_url(); ?>assets/images/fashion.png" class="img-responsive">
	
        </div>
<section>		
<div class="container inner" style="padding:60px 0px;">
<?php 
if($this->session->flashdata('flash_message')){
	if($this->session->flashdata('flash_message') != '') {
 		echo '<center><div class="alert alert-danger" style="float: none;">';
           echo '<a class="close" data-dismiss="alert">×</a>';
            echo $this->session->flashdata('flash_message');
          echo '</div></center>';
      }
}
 ?>

						<?php if(empty($products)) {
							?>	<p>Product not found.</p><?php } else {?>			
						
						<?php if($prod['cost']==$prod['p_d_price']){$discount="";}else{$disc=$prod['cost']-$prod['p_d_price'];
		$discount="<p class='disc'>".round($disc/$prod['cost']*100) ."% OFF </p>";}
		
		if($prod['cost']==$prod['p_d_price']){$procost="";}else{$procost="<span> Rs.  ".$prod['p_d_price']."</span>";}
		?>
						
						
						<div class="row" style="margin:0px;">			
						<div class="col-sm-10 col-sm-offset-1 padding-right">
						<div class="product-details"><!--product-details-->	
						<div class="col-sm-4">	
						<div class="view-product imgBox">	
						<?php if($prod['image']=='') { 	$image_url = base_url().'images/product.jpg';	} else {$image_url = base_url().'main-admin/images/product/'.$prod['image'].'';	} ?>	
						<img src="<?php echo $image_url;?>" alt="" class="img-responsive" data-origin="<?php echo $image_url;?>">
						</div>	
						
						

						
						 <div id="similar-product" class="carousel slide" data-ride="carousel"> 	
						<div class="carousel-inner">																		<?php if($prod['images']!='' && $prod['images']!='[]') { 		$images = json_decode($prod['images']); echo '<div class="item active">';		foreach($images as $image) {		  echo '<a href=""><img src="'.base_url().'main-admin/images/product/'.$image.'" alt="" class="img-responsive"></a>';			}		echo '</div>';		 } ?>
						</div>	
						</div>	
						</div>	
						<div class="col-sm-8">
							<div class="product-information"><!--/product-information-->
							<?php echo $discount;?>	
								
							<h2><?php echo $prod['pname'];?></h2>							
<!--<p>Pro. ID: <?php echo $prod['sku'];?></p>
<p><span class="p_d_price"><?php echo $procost;?></span></p>-->
<p><span class="dp_price"><?php echo 'Rs.   '.$prod['p_d_price'];?></span></p>
								<p class="qtform">
								<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" class="form form-inline crt-btn">	
								<label>Quantity:</label>
								<div class="hide">	
								<input type="hidden" name="name" value="<?php echo $prod['pname'];?>">	
								<input type="hidden" name="id" value="<?php echo $prod['id'];?>">	
								<input type="hidden" name="image" value="<?php echo $image_url;?>">	
								</div>
								<input type="number" required min="1" name="qty"  value="1" class="form-control qty-no" placeholder="Qty.">
								<button type="submit" class="btn btn-fefault cart">	
								<i class="fa fa-shopping-cart"></i>Add to cart					
								</button>
								</form>	
								</p>	 
								<p><b>PV:</b> <?php echo $prod['comm_dis'];?></p>
								<p><b>Availability:</b> In Stock</p>
								
								<p><b>Rating:</b><img src="<?php echo base_url().'assets/front/images'; ?>/rating.png" alt="" /></p>
		
								</div><!--/product-information-->	
								</div>			
								</div><!--/product-details-->
								<div class="category-tab shop-details-tab"><!--category-tab-->
								<div class="col-sm-12">	
								<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
								<li ><a href="#reviews" data-toggle="tab">Reviews</a></li>
								</ul>
								</div>	
								
								<div class="tab-content">
								<div class="tab-pane fade  active in" id="details" >
								<div class="col-sm-12">
								
								<?php echo $prod['description'];?>																		
								</div>
								</div>
								
								<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">	

                <?php if(!empty($review)) 
				{foreach($review as $reviews) { 

					//print_r ($reviews);
					
				
					
				echo	'<div class="apr-review"><ul>						
								<li><a href=""><i class="fa fa-user"></i>'.$reviews['name'].'</a></li>
								<li><a href=""><i class="fa fa-clock-o"></i>'.date('h:i A',strtotime($reviews['r_date'])).'</a></li>
								<li><a href=""><i class="fa fa-calendar-o"></i>'.date('d F Y',strtotime($reviews['r_date'])).'</a></li>

								</ul>									
								<p>'.$reviews['comment'].'</p></div>';
					} 
				} ?>


								<p><b>Write Your Review</b></p>	
								<div id="review-msg-div"></div>
								 <form class="form" action="" method="post" id="review">
								<span>					
								<input required type="text" name="name" placeholder="Your Name"/>
								<input required type="email" name="email" placeholder="Email Address"/>
								<input  type="hidden" name="pro_id" value="<?php echo $prod['id'];?>"/>										
								</span>		
								<textarea required name="comment" ></textarea>
								
								<input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
								<label class="star star-5" for="star-5"></label>
								<input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
								<label class="star star-4" for="star-4"></label>
								<input class="star star-3" id="star-3" type="radio" name="rating"value="3"/>
								<label class="star star-3" for="star-3"></label>
								<input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
								<label class="star star-2" for="star-2"></label>
								<input class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
								<label class="star star-1" for="star-1"></label>
								
								
								<input type="submit" name="submit" value="Submit" class="btn btn-primary popup-register-button">
								</form>	
								</div>	
								</div>	
								</div>	
								</div><!--/category-tab-->										
								
								
								</div>	
								</div>	
								<?php } ?>		
								</div>	
								</section>	

<style>
	#owl-product .owl-nav{text-align:center;}
	#owl-product .owl-nav div {position: relative;top: 0;font-size: 22px !important;width: 55px;height: 40px;display: inline-block;margin: 1px 23px;}
	
.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 1px;
  font-size: 23px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
.fb_iframe_widget span {

    display: inline-block;
    position: relative;
    text-align: justify;
    width: 0px !important;

}
</style>

