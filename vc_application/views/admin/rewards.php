 <?php $this->load->view('includes/admin/sidebar'); ?>
  <?php $user = $profile[0];
if($user['gender']=='Male'){$tit="Mr.";}
elseif($user['gender']=='Female'){$tit="Ms.";}
elseif($user['gender']=='Company'){$tit="M/S";}
else{$tit=" ";}  ?>
 <!-- /.mainbar -->
 <link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url(); ?>assets/css/print.css">
 
<div class="container">
  <div class="content">
    <div class="content-container">

<div class="col-sm-12 no-print reward">

<h1>Rewards</h1>
<h3> Total BV Achieved: <?php echo $profile[0]['business']; ?> ( Self + Direct : <?php echo round($direct_business,2); ?> + Team : <?php echo round($team_business,2); ?>)</h3>
<!--<h4>1 BV = Rs. 10</h4>  -->
  
</div>
<div class="row">
<div class="col-md-12">
	
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 2) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/mobile.jpg">
			</div>
			<div class="reward_text">
				<h1>Mobile</h1>
				<p> 2400 BV</p>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 1) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
				

			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/led.jpg">
			</div>
			
			<div class="reward_text">
				<h1>LED</h1>
				<p> 8400 BV</p> 
			</div>
		</div>
	</div>
	
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 3) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Fridge.jpg">
			</div>
			<div class="reward_text">
				<h1>Refrigerator</h1>
				<p> 20,400 BV</p>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 4) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/bike.jpg">
			</div>
			<div class="reward_text">
				<h1>Bike</h1>
				<p> 42,900 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 5) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/goa.jpg">
			</div>
			<div class="reward_text">
				<h1>Goa</h1>
				<p> 83,400 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 6) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/dubai.jpg">
			</div>
			<div class="reward_text">
				<h1>Dubai</h1>
				<p> 168,900 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 7) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Enfield.jpg">
			</div>
			<div class="reward_text">
				<h1>Enfield</h1>
				<p> 314,400 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 8) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Alto.jpg">
			</div>
			<div class="reward_text">
				<h1>Alto</h1>
				<p> 564,900 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 9) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Swift.jpg">
			</div>
			<div class="reward_text">
				<h1>Swift/Baleno</h1>
				<p> 1,025,400 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 10) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Thar_Creta.jpg">
			</div>
			<div class="reward_text">
				<h1>Thar/Creta</h1>
				<p> 1,905,900 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 11) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/2BHK_Flat.jpg">
			</div>
			<div class="reward_text">
				<h1>2BHK Flat</h1>
				<p> 3,386,400 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 12) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/3BHK_Flat.jpg">
			</div>
			<div class="reward_text">
				<h1>3BHK Flat</h1>
				<p> 5,766,900 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 13) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Endeavour.jpg">
			</div>
			<div class="reward_text">
				<h1>Endeavour</h1>
				<p> 9,197,400 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 14) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/BMW.jpg">
			</div>
			<div class="reward_text">
				<h1>BMW</h1>
				<p> 14,127,900 BV</p>
			</div>
		</div> 
	</div>
	
	<div class="col-md-3">
		<div class="rewardss">
			<?php if($profile[0]['reward'] >= 15) {
				echo '<i class="fa fa-check" aria-hidden="true"></i>';
			}?>
			<div class="imgggg">
				<img src="<?php echo base_url(); ?>assets/images/Villa.jpg">
			</div>
			<div class="reward_text">
				<h1>Villa</h1>
				<p> 21,484,400 BV</p>
			</div>
		</div> 
	</div>
	 
	
</div>
</div>
</div>
</div>
</div>