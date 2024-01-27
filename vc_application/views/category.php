 <div class="sub_banner">
		<img src="<?php echo base_url(); ?>assets/images/fashion.png" class="img-responsive">
	
        </div>

<div class="container">
<?php 
if(empty($category)) { ?>

<h2> Category not found</h2>

<?php } else { ?>
<!--div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center"><?php echo ucfirst($this->uri->segment(2));?></h2>
				</div>			 		
			</div--> 

<?php //print_r($category); ?>

 
 	<!--section id="advertisement">
		<div class="container">
			<div class="col-sm-3 collection_img"><?php echo '<img src="'.base_url().'main-admin/images/category/'.$category[0]['image'].'" class="img-responsive">'; ?></div>
		<div class="col-sm-9 collection_desc">
			
			<div class="rte">
			<?php echo $category[0]['c_description'];?>
			</div>
			
		</div>
		</div>
	</section-->

 

<section>
		<div class="container" style="padding:40px 15px;">
			<div class="row">
	
				<div class="col-sm-12">
 


			
						<?php 


						$cart = $this->cart->contents();
					  $x = array_keys($cart);
					  $y = array_column($cart, 'id');
					  $z = array_combine($y, $x);


if(!empty($category_product)) { 
	foreach($category_product as $categoryproduct) {
		$qty = 0;
		$field1 = 'style="display:none"';
		$add_to_cart = '';
		if(array_key_exists($categoryproduct['id'], $z)) {
				$add_to_cart = 'style="display:none"';
				$field1 = '';
				$qty = $cart[$z[$categoryproduct['id']]]['qty'];
		}
		
		
		
		if($categoryproduct['cost']==$categoryproduct['p_d_price']){$discount="";}else{$disc=$categoryproduct['cost']-$categoryproduct['p_d_price'];
		$discount="<p class='disc'>".round($disc/$categoryproduct['cost']*100) ."% OFF </p>";} 
		 
		if($categoryproduct['cost']==$categoryproduct['p_d_price']){$procost="";}else{$procost="<span> Rs. ".$categoryproduct['cost']."</span>";}
		
		if($categoryproduct['product_type']==1){$ribbon="Gold";}elseif($categoryproduct['product_type']==2){$ribbon="Star";}elseif($categoryproduct['product_type']==3){$ribbon="";}elseif($categoryproduct['product_type']==4){$ribbon="Silver";}elseif($categoryproduct['product_type']==5){$ribbon="Platinum";}elseif($categoryproduct['product_type']==6){$ribbon="Diamond";}else{$ribbon="";}
		
		
		if($categoryproduct['image']==''){ $pimage = base_url().'assets/front/images/products1.jpg'; }
		else { $pimage =  base_url().'main-admin/images/product/'.$categoryproduct['image'].''; }
			  
		 if($categoryproduct['on_hover']!=''){ $hover='<a href="'.base_url().'divino-product/'.$categoryproduct['p_id'].'"><div class="product-overlay">
											<div class="overlay-content">
											<img src="'.base_url().'main-admin/images/product/'.$categoryproduct['on_hover'].'" class="img-responsive">
											
												<p>'.$categoryproduct['pname'].'</p>
												<a href="'.base_url().'divino-product/'.$categoryproduct['p_id'].'" class="btn btn-default add-to-cart ajax-add-to-cart" data-pid="'.$categoryproduct['p_id'].'" data-id="'.$categoryproduct['id'].'" data-name="'.$categoryproduct['pname'].'" data-cls=".addtocart-'.$categoryproduct['id'].'" data-img="'.$pimage.'"><i class="fa fa-shopping-cart"></i><span class="addtocart-'.$categoryproduct['id'].'">Add to cart</span></a> <a href="'.base_url().'divino-product/'.$categoryproduct['p_id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View More</a>
											</div>
										</div></a>';}else{$hover='';}
		
		
		
	echo '<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
								<div class="ribbon-wrapper-green"><div class="">'.$ribbon.'</div></div>
								
										<div class="productinfo text-center"><a href="'.base_url().'divino-product/'.$categoryproduct['p_id'].'">';
										
											if($categoryproduct['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$categoryproduct['image'].'" class="img-responsive">'; }
											
		echo'	</a>								
								<form action="'.base_url().'bliss-product/'.$categoryproduct['p_id'].'" id="addtocartform-'.$categoryproduct['id'].'" class="form form-inline addtocartform" method="post" data-pid="'.$categoryproduct['p_id'].'" data-cls="#addtocartform-'.$categoryproduct['id'].'">
		                                    <a href="'.base_url().'divino-product/'.$categoryproduct['p_id'].'"><p>'.$categoryproduct['pname'].'</p></a>
		                                    <p class="mrp">Rs : '.$categoryproduct['p_d_price'].' <!--del>'.$categoryproduct['price'].'</del--></p>
																				<a href="javascript:;" data-qty="0" '.$add_to_cart.' class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><span>Add</span> <i class="fa fa-plus" aria-hidden="true" id="d-flex"></i></a>
																				<div class="field1" '.$field1.' style="">
																				<input type="hidden" name="image" value="'.$pimage.'">
<input type="hidden" name="id" value="'.$categoryproduct['id'].'">
<input type="hidden" name="name" value="'.$categoryproduct['pname'].'">
    <button type="button"  class="sub-qty">-</button>
    <input type="text" name="qty" class="qty" value="'.$qty.'" min="0" max="10">
    <button type="button"  class="add-qty">+</button>



</div>
</form>
											<h2 style="display:none;">Affiliate Price : '.$categoryproduct['p_d_price'].'</h2>
											<h2 style="display:none;">LBV : '.$categoryproduct['comm_dis'].'</h2>';
											
							
											//<a href="'.base_url().'bliss-product/'.$categoryproduct['p_id'].'" class="btn btn-default add-to-cart ajax-add-to-cart" data-pid="'.$categoryproduct['p_id'].'" data-id="'.$categoryproduct['id'].'" data-name="'.$categoryproduct['pname'].'" data-cls=".addtocart-'.$categoryproduct['id'].'" data-img="'.$pimage.'"><i class="fa fa-shopping-cart"></i><span class="addtocart-'.$categoryproduct['id'].'">Add to cart</span></a> <a href="'.base_url().'bliss-product/'.$categoryproduct['p_id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View More</a>
											
									echo	'</div>
										<a href="'.base_url().'divino-product/'.$categoryproduct['p_id'].'">
										'.$hover.'
									</a>
								</div> 
							</div>
						</div>
						';	
	
		}
} 

 if(!empty($category_all_product) && count($category_all_product) > 1) {
  $page = count($category_all_product) / 18;
  $page = ceil($page);
  echo '<div class="clearfix"></div><ul class="pagination">';
  
 
   
  for($i=0;$i<$page;$i++) {
	  $pageNo = $i + 1;
	  echo '<li';
	  if($pageNo == $this->uri->segment(4))  { echo ' class="active" '; }
	  echo '><a href="/category/'.$this->uri->segment(2);
	  if($i!='0') { echo '/page/'.$pageNo; } 
	  echo '">'.$pageNo.'</a></li>'; 
  }
  
  if($this->uri->segment(4)==0){
    $np=$this->uri->segment(4)+2;
  }else {$np=$this->uri->segment(4)+1;}
  if($i==$this->uri->segment(4)){}
   elseif($i>1) {echo '<li><a href="/category/'.$this->uri->segment(2).'/page/'.$np.'"> Next Page  </a></li>';}
   
  echo '</ul>';
  
}	?>
						
	</div>
			</div>
		</div>
	</section>					
		
<script>
jQuery(document).ready(function() {
	//jQuery('.ajax-add-to-cart').click(function(e){
	jQuery('form.addtocartform').submit(function(event) {
		event.preventDefault();
		var cls = jQuery(this).attr('data-cls');
		var pid = jQuery(this).attr('data-pid');
		var items = parseInt(jQuery('.h-cart-item').html()) + 1;
		jQuery.ajax({
              type:"POST",
              url:"<?php echo base_url().'divino-product/';?>"+pid,
              data:jQuery(cls).serialize(), 
              success : function(data){ 
				     jQuery(cls).css('visibility','hidden'); 
				     jQuery('.h-cart-item').html(items);
				   }
		});
	});




	$('.add-qty').click(function () {
		//var max_qty = $(this).prev().attr('max');
		if ($(this).prev().val() < 10) {
    	$(this).prev().val(+$(this).prev().val() + 1);

    	var form =  $(this).closest('.addtocartform');
			var pid = jQuery(form).attr('data-pid');
		
		var items = parseInt(jQuery('.h-cart-item').html()) + 1;
		jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url().'add-product/';?>"+pid,
                   data:jQuery(form).serialize(), 
                   success : function(data){ 
				    if(data!='') { alert(data); }
				    var cart = $('.h-cart-item').html();
						$('.h-cart-item').html(parseInt(cart)+1);
						$('.item-count').html(parseInt(cart)+1);
				   }
		});
    	
		}
});
$('.sub-qty').click(function () {
		if ($(this).next().val() > 0) {
    	if ($(this).next().val() > 0) { $(this).next().val(+$(this).next().val() - 1); }
    	if ($(this).next().val() == 0) {
    	var field1 = $(this).closest('.productinfo').find('.field1');
			var addtocart = $(this).closest('.productinfo').find('.add-to-cart');
			$(field1).css("display","none");
			$(addtocart).css("display","flex"); }
    	

			var form =  $(this).closest('.addtocartform');
			var pid = jQuery(form).attr('data-pid');
		
		var items = parseInt(jQuery('.h-cart-item').html()) + 1;
		jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url().'add-product/';?>"+pid,
                   data:jQuery(form).serialize(), 
                   success : function(data){ 
				    if(data!='') { alert(data); }
				    var cart = $('.h-cart-item').html();
								$('.h-cart-item').html(parseInt(cart)-1);
								$('.item-count').html(parseInt(cart)-1);
				   }
		});

		} 
});

		jQuery('.add-to-cart').click(function(event) {
			
			var $this = $(this);
			
			//$('.fx_cart').show();
			$('.fx_cart').css("display","block");
			var form =  $(this).closest('.addtocartform');
			var pid = jQuery(form).attr('data-pid');
		
		var items = parseInt(jQuery('.h-cart-item').html()) + 1;
		var form_data = jQuery(form).serialize();
		form_data += '&qty=1';
		jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url().'add-product/';?>"+pid,
                   data:form_data, 
                   success : function(data){ 
				    if(data!='') { alert(data); } else {
				    		var qty = $($this).attr('data-qty');
								$($this).hide();
								var fd = $($this).closest('.productinfo').find('.field1');
								var qty = $($this).closest('.productinfo').find('.qty');
								$(fd).css("display","flex");
								$(qty).val(1);
								var cart = $('.h-cart-item').html();
								$('.h-cart-item').html(parseInt(cart)+1);
								$('.h-cart-item').html(parseInt(cart)+1);
								
				    }
				   }
		});


			
	});
	/*jQuery('.ajax-add-to-cart').click(function(e){
		e.preventDefault();
		var cls = jQuery(this).attr('data-cls');
		var id = jQuery(this).attr('data-id');
		var pid = jQuery(this).attr('data-pid');
		var name = jQuery(this).attr('data-name');
		var img = jQuery(this).attr('data-img');
		var items = parseInt(jQuery('.h-cart-item').html()) + 1;
		jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url().'bliss-product/';?>"+pid,
                   data:"name="+name+"&id="+id+"&qty=1&image="+img+"", 
                   success : function(data){ 
				     jQuery(cls).html('Added');
				     jQuery('.h-cart-item').html(items);
				   }
		});
	});*/
});
</script>


<?php } /**************** endif category not found ******************/ ?>
</div>