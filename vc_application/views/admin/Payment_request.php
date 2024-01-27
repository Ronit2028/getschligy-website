<?php $this->load->view('includes/admin/sidebar'); ?>


<div class="container"> 
 <div class="content">   
 <div class="content-container"> 

     


	 <!-- <div class="content">-->
	  <div class="request-form col-sm-8 col-sm-offset-2 redeemrrr">
        <div class="no-print">
		<h2>Redeem Fund Request</h2>
		</div>
		
		
		<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> Request Sent successfully.';
          echo '</div>';       
        }  elseif($this->session->flashdata('flash_message') == 'already_updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> Already Request Sent. Your Wallet Will be credit whithing 2 days..';
          echo '</div>';       
        } 
        else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong> Request Not Sent.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
	  
	   
      <?php
	  
	  $level_income = $direct_income = $repurchase_income = 0;
if(!empty($total_incomes)) {
	foreach($total_incomes as $val) {
		if($val['type']=='Level') { $level_income = $level_income + $val['amount']; } 
		if($val['type']=='Direct') { $direct_income = $direct_income + $val['amount']; } 
		if($val['type']=='Team Performance Bonus') { $repurchase_income = $repurchase_income + $val['amount']; }  
	}
} 
	  
	  
	  $time= date("H");
	  $day= date("l");
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	
    
      echo form_open('admin/Payment_request', $attributes);
	  if(1==1) { 
      ?>
	  
		<input type="hidden" name="profile_com">
		<div class="col-sm-12 form-group"><label>Balance</label> <input id="balance"  required type="text" readonly name="balance" value="<?php  echo $wallet_amount ;  ?>" class="form-control"></div>
		
		<div class="col-sm-12 form-group"><label>Redeem</label> <input id="redeem" required type="number" step="5" min="100"  name="redeem" value="" class="form-control"></div>
		
		<div class="col-sm-12 form-group"><label>Redeemed balance after transaction charges (TDS + Admin)</label> <input id="final_redeem" type="text" name="final_redeem" value="<?php if($this->input->post('redeem')!='') { echo $this->input->post('redeem'); } ?>" class="form-control"></div>
		
		<div class="col-sm-12 form-group"><label>Balance after Redeem</label> <input type="text" id="after_redeem" name="after_redeem" value="" class="form-control"></div>
		
		
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input required type="checkbox" name="declare" value="1"> I hereby declared that the details furnished above correct to the best of my knowledge and belief. Redemption request is subject to approval from company.</label></div>
		
		
		<div class="col-sm-12"><input type="submit" name="redeem_bliss" value="Confirm Request" class="btn btn-primary " style="color:#fff;"></div>
		
	<?php  
	  echo form_close(); 
	   ?>
      </div> 
     <!-- </div> -->
      <div class="request-form col-sm-12">
      
        <div class="table-responsive">
	  <table class="table" style="width:100%">
  <tr>
   <th>Sr. no</th>
    <th>Redeemed Amt.</th>
    <th>Redeemed Amt. after TDS</th> 
    <th>Request</th>
    
    <th>Date</th>
    <th>Status</th>
  </tr>
	  <?php

if(!empty($bliss_perk_history)) {
	$id=1;
	foreach($bliss_perk_history as $perk_history) {
		echo "<tr><td>".$id."</td><td>".$perk_history['redeem']."</td><td>".$perk_history['after_tds']."</td><td>".$perk_history['my_bliss_req']."</td><td>".$perk_history['rdate']."</td><td>".$perk_history['redeem_status']."</td></tr>";
		$id++;
	}
} ?>
</table></div> </div></div></div></div>
     
	  <?php } else { 
	  
	  echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'You can redeem wallet amount on 9 AM To 2 PM On Monday to Saturday..';
          echo '</div>';
	  
	  } ?> 
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
<script>

     jQuery('#redeem').keyup(function(){
        
	          var redeem = jQuery("#redeem").val();
			  var balance = jQuery("#balance").val();
			  var cash = parseFloat(balance-redeem);  
			  var bliss = parseFloat(redeem*0.90);
			  jQuery("#final_redeem").val(bliss.toFixed(2));
			  jQuery("#after_redeem").val(cash.toFixed(2));
		  });
		  
		  
		  jQuery('#type').change(function(){ 
		      
		      $(".form").submit();
		  });
</script>

	  