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
<h2 class="to0-de">Bliss <span>Products</span>  <a href="" class="view-all">View All</a></h2>

<div class="col-sm-12 col-pro-12">
 
<div id="owl-demo" class="col-sm-12 owl-carousel">
 
<?php 
if(!empty($bliss_product)) { 
	foreach($bliss_product as $prod) {
	  echo '<div class="item">
             <div class="col-pro-3">
                <div class="col-img-2"><a href="'.base_url().'bliss-product/'.$prod['p_id'].'">';
              if($prod['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$prod['image'].'" class="img-responsive">'; }
       echo           '<img src="'.base_url().'assets/front/images/str.png" class="srt-0">
                </a></div>
               <h4>'.$prod['pname'].'</h4>
              <span>'.$prod['p_id'].'</span>
              <strong>₹'.$prod['cost'].'</strong>
              <a class="buynow" href="'.base_url().'bliss-product/'.$prod['p_id'].'">BUY NOW</a>
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
<section class="col-sm-12 col-mrt-12">
<h2 class="to0-de">Deals <span>Zone</span>  <a href="" class="view-all">View All</a></h2>
<div class="col-sm-12 col-mrc-12">

<!--a href="" class="slo1 aro"><img src="<?php echo base_url(); ?>assets/front/images/sl.png"></a-->
<div id="owl-demo2"  class="col-sm-12  owl-carousel">
	
	<div class="item">

	<?php 
if(!empty($merchant_list)) { 
	$d = 0;
	foreach($merchant_list as $merch) {
		
		if(($d%2)==0 && $d!=0) { echo ' </div> 
		<div class="item">'; }
	  echo '<div class="col-mrc-3 '.$d.'">'; 
              if($merch['brand_proof']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'merchants/images/profile/business_details/'.$merch['brand_proof'].'" class="img-responsive">'; }
		echo	'<div class="col-mrc-2"><a href="/deals/'.$merch['merchant_id'].'">Get Now</a>
				<h4>'.$merch['d_name'].'</h4>
				<span>Heading</span> 
			</div>
			</div>';  
		$d++;
	}
} ?>
		</div>	
</div>
<!--a href="" class="slo2 aro"><img src="<?php echo base_url(); ?>assets/front/images/sr.png"></a-->
</div>



</section>
<!-- merchant section -->
<section class="col-sm-12 col-onm-12 text-center">
<div class="col-sm-12 col-pro-12">
<div id="owl-demo3"class="col-sm-12 owl-carousel">
 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Big-Bazaar.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Dominos.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Funcity.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Gopal.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/KFC.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Mark-Spencer.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Pizza-hut.jpg"></a></div> 
<div class="item">  <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/Reliance-Fresh.jpg"></a></div> 
</div>
</div>
</section>
<!-- online website -->
<section class="col-sm-12 col-ect-12 text-center">
<h2 class="to0-de">Exclusive <span>Deals</span>  <a href="" class="view-all">View All</a></h2>

<div class="col-sm-12 col-ectdls-12">
<!--a href="" class="slo1 aro"><img src="<?php echo base_url(); ?>assets/front/images/sl.png"></a-->
<div id="owl-demo4"class="col-sm-12 owl-carousel">
 <div class="item">
<div class="col-sm-6 col-ectdls-6 col-ectdls-1">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive1.jpg"></a>
</div>
<div class="col-sm-6 col-ectdls-6 col-ectdls-1">
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive2.jpg"></a>
</div> 
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive3.jpg"></a>
</div>
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive4.jpg"></a>
</div>
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive5.jpg"></a>
</div>
</div>

</div> <div class="item">
<div class="col-sm-6 col-ectdls-6 col-ectdls-1">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive1.jpg"></a>
</div>
<div class="col-sm-6 col-ectdls-6 col-ectdls-1">
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive2.jpg"></a>
</div> 
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive3.jpg"></a>
</div>
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive4.jpg"></a>
</div>
<div class="col-sm-6 col-ectdls-6">
<a href=""><img src="<?php echo base_url(); ?>assets/front/images/Exclusive5.jpg"></a>
</div>
</div>

</div>
</div>
<!--a href="" class="slo2 aro"><img src="<?php echo base_url(); ?>assets/front/images/sr.png"></a-->
</div>

</section>
<!-- Exclusive section close -->

<section class="col-sm-12 col-web-12">
<h2 class="to0-de">Bliss <span>Web stores</span>  <a href="" class="view-all">View All</a></h2>
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

<!--webstore close -->


<section class="col-sm-12 col-new-12">
<h2 class="to0-de">Best <span>Sellers</span>  <a href="" class="view-all">View All</a></h2>
<div class="col-sm-12 col-pro-12"> 
<div id="owl-demo6" class="col-sm-12 col-newmg-12 owl-carousel">
	<?php 
if(!empty($bliss_product)) { 
	foreach($bliss_product as $prod) {
	  echo '<div class="item">
             <a href="'.base_url().'bliss-product/'.$prod['p_id'].'">';
              if($prod['image']==''){ echo '<img src="'.base_url().'assets/front/images/new.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$prod['image'].'" class="img-responsive">'; }
       echo '</a></div>';	
	}
} ?> 
</div>
</div>

</section>

<!-- Arrivals close -->

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
	
	   $("#owl-demo").owlCarousel({
            margin: 10,
                nav: true,
                loop: true,
                responsive: {
                  0: {
                    items:2
                  },
                  600: {
                    items: 3
                  },
                  1000: {
                    items: 4
                  }
                }
              })
	   $("#owl-demo2").owlCarousel({
            margin: 10,
                nav: true,
                loop: true,
                responsive: {
                  0: {
                    items:2
                  },
                  600: {
                    items: 3
                  },
                  1000: {
                    items: 4
                  }
                }
              })
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
              })
	   $("#owl-demo4").owlCarousel({
            margin: 10,
                nav: true,
                loop: true,
               
                    items:1
                 
              })
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
              })
			    $("#owl-demo6").owlCarousel({
                         nav: true,
                loop: true,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items: 3
                  },
                  1000: {
                    items: 4
                  }
                }
              })
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
