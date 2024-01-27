<div class="col-sm-12 slider">
<img src="<?php echo base_url(); ?>assets/front/images/slider.jpg">
</div>
<section class="col-sm-12 col-sld-12">
<div class="col-sm-3 col-bx-2">
Get rewards
</div>
<div class="col-sm-3 col-bx-4">
generate deals
</div>
<div class="col-sm-3 col-bx-6">
shop free
</div>
<div class="col-sm-3 col-bx-8">
play bonanza
</div>
</section>
<!-- slider close -->

<section class="col-sm-12 producs-shop text-center">
<h2 class="to0-de">Bliss <span>Products</span>  <!--a href="" class="view-all">View All</a--></h2>

<div class="col-sm-12 col-pro-12">
 
<div id="owl-demo" class="col-sm-12">
 
<?php 
if(!empty($bliss_product)) { 
	foreach($bliss_product as $prod) {
		
		
		$disc=$prod['cost']-$prod['p_d_price'];
		$discount=$disc/$prod['cost']*100;
		

	  echo '<div class="col-sm-3">
             <div class="col-pro-3" style="margin-bottom:17px;">
                <div class="col-img-2"><a href="'.base_url().'bliss-product/'.$prod['p_id'].'"> <span class="product_badge ">New</span> <span class="product_badge new">'.round($discount, 0).'% OFF</span>';
              if($prod['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$prod['image'].'" class="img-responsive">'; }
       echo           '<img src="'.base_url().'assets/front/images/str.png" class="srt-0">
                </a></div>
				<div class="product_price"> 
				
				<strong>₹'.$prod['p_d_price'].'</strong><span class="money money_sale">₹'.$prod['cost'].'</span>
				</div>
				<div class="product_name"> 
               <h4>'.$prod['pname'].'</h4>
			   </div>
			   <!--div class="product_id"> 
              <span>'.$prod['p_id'].'</span>
			  </div-->
			  <div class="product_link"> 
              <a class="product_links" href="'.base_url().'bliss-product/'.$prod['p_id'].'">
			  <span class="glyphicon glyphicon-menu-hamburger"></span> </a>
			  <a class="product_links" href="'.base_url().'bliss-product/'.$prod['p_id'].'"><span class="glyphicon glyphicon-info-sign"></span></a>
			  <a class="product_links" href="'.base_url().'bliss-product/'.$prod['p_id'].'"><span class="glyphicon glyphicon-eye-open"></span></a>
			  </div>
              
            </div>
         </div>';	
	}
} ?>

 
</div>
 
 <!--div class="owl-nav">
 <div class="owl-prev aro"><img src="<?php echo base_url(); ?>assets/front/images/sl.png"></div>
 <div class="owl-next aro"><img src="<?php echo base_url(); ?>assets/front/images/sr.png"></div>
 </div-->
 
 </div>

</section>
<!-- products section close -->
 

<!-- Exclusive section close -->

<section class="col-sm-12 col-web-12">
<h2 style="margin-bottom:8px;" class="to0-de">Bliss <span>Web stores</span>  <a href="" class="view-all">View All</a></h2>
<div class="col-sm-12 col-pro-12"> 
<div id="owl-demo5"class="col-sm-12 owl-carousel">

	
<?php 
if(!empty($bliss_web_stores)) { 
	foreach($bliss_web_stores as $webstore) {
		echo '<div class="item"><a target="_blank" href="'.$webstore['web_url'].'"><img src="'.base_url().'main-admin/images/webstores/'.$webstore['web_img'].'"></a>
	  <!--a target="_blank" href="'.$webstore['web_url'].'"><img src="'.base_url().'main-admin/images/webstores/'.$webstore['web_img'].'"></a--></div>';	
	}
} ?>
	
</div>
  
</div>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<section class="col-sm-12 col-hpy-12">
<h2 class="to0-de">Happy <span>Buyers</span>  </h2>
 
<div class="col-sm-12 col-hpby-12">
 
<div class=" col-sm-3">
<div class="col-sm-21"><a href=""><img src="<?php echo base_url(); ?>assets/front/images/man.jpg">
<div class="text-data"><h2>Name</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
</div>
</a></div></div>
<div class=" col-sm-3">
<div class="col-sm-21"><a href=""><img src="<?php echo base_url(); ?>assets/front/images/man.jpg">
<div class="text-data"><h2>Name</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
</div>
</a></div></div>
<div class=" col-sm-3">
<div class="col-sm-21"><a href=""><img src="<?php echo base_url(); ?>assets/front/images/man.jpg">
<div class="text-data"><h2>Name</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
</div>
</a></div></div>
<div class=" col-sm-3">
<div class="col-sm-21"><a href=""><img src="<?php echo base_url(); ?>assets/front/images/man.jpg">
<div class="text-data"><h2>Name</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
</div>
</a></div></div>
 
 
 
 
 
  
</div> 
</section>
 <link href="<?php echo base_url(); ?>assets/front/css/owl.carousel.min.css" rel="stylesheet">
<script>
  
	  $(document).ready(function() {
	
	   $("#owl-demo3").owlCarousel({
            margin: 10,
                nav: true,
                loop: true,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items: 4
                  },
                  1000: {
                    items: 6
                  }
                }
              });
			  
			    $("#owl-demo5").owlCarousel({
            margin: 10,
                nav: true,
                loop: true,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items: 4
                  },
                  1000: {
                    items: 6
                  }
                }
              });
              });

			<?php if(strstr($_SERVER['REQUEST_URI'],'/reference/')) { ?>
	$(window).load(function() {
				$("#registerLoginModal").modal("show");
                $('#bliss_code_input').val('<?php echo $this->uri->segment(2);?>');
                $('#bliss_code_input').attr('readonly','readonly');
	});
			<?php } ?>
			
</script> 
<!-- happy client close -->
