<?php $this->load->view('includes/admin/sidebar'); ?>
<?php 
$user = $profile[0]; 
//echo '<pre>'; print_r($user); echo '</pre>';
if($user['gender']=='Male'){$tit="Mr.";}
elseif($user['gender']=='Female'){$tit="Ms.";}
elseif($user['gender']=='Company'){$tit="M/S";}
else{$tit=" ";}
?>
<style>
.ppimg{padding:0 3px 17px 0;float:left}
</style>

<style>
 .table > tbody > tr.reward {background:#5cb85c}
 .table th{text-align:center;}
 .table td{text-align:center;}
 .bt{
	background: #ED5922;
	border-color: #ED5922;
}
.bt:hover{
	background: #ED5922;
	border-color: #ED5922;
}
  .table-striped > tbody > tr.reward {background:#5cb85c}
</style>



 <!-- /.mainbar -->
<div class="container">

  <div class="content">
    <div class="content-container">
      <?php if(!empty($news)) { 

       ?>
  <!---   <div class="col-sm-12">
      <div class="news-text1">
        <div class=" con-w3l" >
          <marquee class="ind-home" direction="left" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
              <?php echo $news[0]['discription']; ?>
          </marquee>
        </div> 
      </div>
  </div>   --->
<?php } ?>
    	 <div class="clearfix"></div>
		<?php if($profile[0]['var_status']=='reject') 

	{
  echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo $profile[0]['doc_note'];
          echo '</div>';
}


	
	?>
   <?php 

        if($this->session->flashdata('flash_message')=='updated') {
            echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Scholarship Form Submitted Successfully.</strong></div>';

            } 

      if($this->session->flashdata('flash_message')=='error') {
            echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>You already applied for scholarship. Please Track your Application.</strong></div>';

            }

        ?>
		<h2 class="content-header-title">Welcome <?php echo $tit.' '. ucfirst($this->session->userdata('full_name'));?></h2>
		
      

		
      <div class="row">
        
        
       <div style="clear:both"></div>
       
	
		 <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Apply For Scholarship</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/images/apply_now.png" align="left" /> <h3>Apply For Scholarship</h3> 
			<form action="" method="POST">
        <button type="submit" class="btn btn-success btn-sm bt">Go</a>
      </form>
			  
            </div> 
          </div> 
        </div>
		

         <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Track Your Application</h3></div> <!-- /.portlet-header -->
            <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/images/application.png" align="left" />
      <h3>Track Your Application</h3>  
      <!-- <p>View Direct Downline from here</p>  [-->
      <a href="<?php echo base_url();?>admin/scholarship" type="button" class="btn btn-success btn-sm bt" >Go</a>
            </div> <!-- /.portlet-content -->
          </div> <!-- /.portlet -->
        </div> <!-- /col-md -->

		<!-- <div class="col-md-3">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Scholarship Test</h3></div> <!-- /.portlet-header -->
          <!--  <div class="portlet-content">
             <img src="<?php //echo base_url(); ?>/assets/front/images/scholarshippp.png" align="left" /> <h3>Scholarship Test</h3> 
			 <!-- <p>Print your welcome letter from here</p>  
			 <a href="<?php //echo base_url();?>quiz" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div> -->
		
		  
		
		 <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Scholarship Letter</h3></div> <!-- /.portlet-header -->
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/images/downline1.png" align="left" /> <h3>Scholarship Letter</h3> <!--<p>Update your login password from here</p>  -->
			  <a href="<?php echo base_url();?>admin/welcomeletter" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> <!-- /.portlet-content -->
          </div> <!-- /.portlet -->
        </div> <!-- /col-md -->
		
	<div class="clearfix"></div>
		
	<!---	
        <div class="col-sm-4 col-md-4">
			 <div class="portlet port1" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF"> Profile</h3></div>
				<div class="portlet-content1">
				<!-- <?php if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="80" class="ppimg">'; } else { echo '<img src="'.base_url().'images/user/logo.png" width="80" class="ppimg">';} ?> -->
		<!---			<ul>
				<li><b>ID :</b> &nbsp;<?php echo $user['customer_id'];?></li>
				<li><b>Sponsor :</b> &nbsp;<?php echo $user['parent_customer_id'];?></li> 
				<li><b>Status :</b>  &nbsp;<?php if($profile[0]['consume']>0) { echo 'Active'; } else { echo 'Inactive'; } ?>

				<?php if($profile[0]['consume']>0) {  ?>
				<img src="<?php echo base_url(); ?>assets/images/green1.png">
				<?php } ?> 
				
				</li> 
				</ul>
				</div>       
			</div><!-- /.row-stat -->
 	<!---       </div> 
		<!-- /.col -->

  	<!---   <div class="col-sm-4 col-md-4">
	 <div class="portlet port1" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF"> Personal Business</h3></div>
    
        <div class="portlet-content1">
        <ul>
        <li><b>PV :</b> &nbsp;<?php echo round($total_pv,2); ?></li>
        <li><b>BV :</b> &nbsp;<?php echo round($total_bv,2); ?></li> 
        <li><b>Monthly Repurchase :</b> &nbsp; Rs <?php echo $monthly_sale[0]['total_amount']+$monthly_pinsale[0]['total_amount']+0; ?></li> 
        </ul>
        </div>       
      </div><!-- /.row-stat -->
  	<!---      </div>
		
		<div class="col-sm-4 col-md-4">
		<div class="portlet port1" style="border-color:#292928;">
        <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF"> Wallet</h3></div>
			
		<h3 class="row-stat-value"><i class="fa fa-credit-card"></i> <?php echo $profile[0]['bliss_amount']; ?></h3>
				<!-- <span class="label label-success row-stat-badge"> Available </span>
				<span class="label label-danger row-stat-badge"> Used 0</span> -->
				
	<!---	    </div> <!-- /.row-stat -->
 	<!---       </div> 
		<!-- /.col -->
		
		
	<!---		<div class="col-sm-4 col-md-4"> 
		<div class="portlet port1" style="border-color:#292928;">
        <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Shelf Income</h3></div> 
        <h3 class="row-stat-value"><?php echo round($shelf_income[0]['total_income'],2)+0;?></h3>
       <!-- <h3 class="row-stat-value"><?php echo round($monthly_income[0]['total_income_fund']+0,2); ?></h3>-->
 	<!---       </div> <!-- /.row-stat -->
 	<!---       </div>
		<div class="col-sm-4 col-md-4"> 
		<div class="portlet port1" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Income Wallet</h3></div>
			  
		<h3 class="row-stat-value"><?php echo $user['income_wallet']; ?></h3>
			  </div> <!-- /.row-stat -->
 	<!---       </div> 
		<!-- /.col -->
 	<!---      <div class="col-sm-4 col-md-4">
       <div class="portlet port1" style="border-color:#292928;">
       <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Total Income</h3></div> 
       
        <h3 class="row-stat-value"><?php echo round($user_total_income,2); ?></h3>
        </div> <!-- /.row-stat -->
  	<!---      </div> 


       
      </div> <!-- /.row -->

  	<!---  <div style="clear:both"></div>		

    <div class="row">

      <?php if($user['consume'] == 0) { ?>
	<div class="col-md-4">
    <div class="portlet" style="border-color:#292928;">
    <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Combo Pack</h3></div> <!-- /.portlet-header -->
  	<!---  <div class="portlet-content">
    <img src="<?php echo base_url(); ?>/assets/images/activatee.png" align="left" /> <h3>Combo Pack</h3> <p>Buy your first combo to activate your ID.</p>  <a href="<?php echo base_url();?>admin/activate_account" type="button" class="btn btn-success btn-sm bt">Buy Combo</a>
    </div> <!-- /.portlet-content -->
 	<!---   </div> <!-- /.portlet -->
	<!---    </div> <!-- /col-md -->
  <?php } ?>
	<!---	<div class="col-md-4">
    <div class="portlet" style="border-color:#292928;">
    <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Total Income</h3></div> <!-- /.portlet-header -->
 	<!---   <div class="portlet-content">
     <img src="<?php echo base_url(); ?>assets/images/incomee.png" align="left" /> <h3>Total Income</h3> <p>View your incomes detail from here</p>  <a href="<?php echo base_url();?>admin/totalincome" type="button" class="btn btn-success btn-sm bt">Go</a>
     </div> <!-- /.portlet-content -->
  	<!---   </div> <!-- /.portlet -->
 	<!---    </div> <!-- /col-md -->
		
		
		
		
		
		
		
    	<!---   <div class="col-md-4">
       <div class="portlet" style="border-color:#292928;">
       <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Profile</h3></div> <!-- /.portlet-header -->
   	<!---    <div class="portlet-content">
       <img src="<?php echo base_url(); ?>/assets/front/images/personaldetails_con.png" align="left" /> <h3>Update Profile</h3> <p>Update your profile from here</p>  <a href="<?php echo base_url();?>admin/profile" type="button" class="btn btn-success btn-sm bt">Go</a>
       <?php if($profile[0]['var_status']=='yes') { echo 'Approved KYC'; } ?>
       </div> <!-- /.portlet-content -->
  	<!---     </div> <!-- /.portlet -->
  	<!---     </div> <!-- /col-md -->


       <!--  <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Bank Details</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/newjoin_icon.png" align="left" /> <h3>Edit Bank Details</h3> <p>Update your bank details from here</p>  <a href="<?php echo base_url();?>admin/profile" type="button" class="btn btn-success btn-sm">Go</a>
            </div> 
          </div>
        </div>


		
	<!-- <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Kyc Details</h3></div> 
            <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/front/images/personaldetails_con.png" align="left" /> <h3>Kyc Details</h3> <p>Kyc Details from here</p>  <a href="<?php echo base_url();?>admin" type="button" class="btn btn-success btn-sm" >Go</a>
            </div> 
          </div> 
        </div> -->

       
        


		
    	<!---   <div class="col-md-4">
       <div class="portlet" style="border-color:#292928;">
       <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Total Sales</h3></div> <!-- /.portlet-header -->
     	<!---  <div class="portlet-content">
       <img src="<?php echo base_url(); ?>/assets/front/images/teamsales.png" align="left" /> <h3>Total Sales</h3> <p>View your team sales from here</p>  <a href="admin/downlinesale" type="button" class="btn btn-success btn-sm bt" >Go</a>
        </div> <!-- /.portlet-content -->
   	<!---     </div> <!-- /.portlet -->
  	<!---      </div> <!-- /col-md -->
		
		
		<!---	<div class="col-md-4">
        <div class="portlet" style="border-color:#292928;">
        <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Total Downline</h3></div> <!-- /.portlet-header -->
   	<!---     <div class="portlet-content">
        <img src="<?php echo base_url(); ?>assets/images/downlinee.png" align="left" /> <h3>Total Downline</h3> <p>View total Downline from here</p>  <a href="<?php echo base_url();?>admin/downlineall" type="button" class="btn btn-success btn-sm bt" >Go</a>
            </div> <!-- /.portlet-content -->
   	<!---       </div> <!-- /.portlet -->
   	<!---     </div> <!-- /col-md -->
		
		
		<!---	<div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">My Downline</h3></div> <!-- /.portlet-header -->
      	<!---      <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/images/downline1.png" align="left" /> <h3>My Downline</h3> <p>View Direct Downline from here</p>  <a href="<?php echo base_url();?>admin/downline" type="button" class="btn btn-success btn-sm bt" >Go</a>
            </div> <!-- /.portlet-content -->
     	<!---     </div> <!-- /.portlet -->
   	<!---     </div> <!-- /col-md -->
		<!---	 <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Print Welcome Letter</h3></div> <!-- /.portlet-header -->
   	<!---         <div class="portlet-content">
             <img src="<?php echo base_url(); ?>/assets/front/images/document-print.png" align="left" /> <h3>Welcome Letter</h3> <p>Print your welcome letter from here</p>  <a href="<?php echo base_url();?>admin/welcomeletter" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> <!-- /.portlet-content -->
  	<!---        </div> <!-- /.portlet -->
  	<!---      </div> <!-- /col-md -->
		
	<!---		 <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Password</h3></div> <!-- /.portlet-header -->
   	<!---         <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/password icon.png" align="left" /> <h3>Change Password</h3> <p>Update your login password from here</p>  <a href="<?php echo base_url();?>admin/password" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> <!-- /.portlet-content -->
  	<!---        </div> <!-- /.portlet -->
  	<!---      </div> <!-- /col-md -->
		
		<!---	 <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Rewards</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/images/reward.png" align="left" /> <h3>Rewards</h3> <p>See Rewards&nbsp; from here</p>  <a href="<?php echo base_url();?>admin/rewards" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div> 
		<div class="clearfix"></div>
		
		 <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Redeem </h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/images/redeeem.png" align="left" /> <h3>Redeem</h3> <p>You Can Redeem From Here</p>  <a href="<?php echo base_url();?>admin/Payment_request" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div> 
		 
		 
		 
		 
		 
		 
		 
		 
		
		 <!-- <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">House Fund</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/house.png" align="left" /> <h3>House Fund</h3> <p>0</p>
			  <a href="<?php echo base_url();?>admin" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div> 
		
		<div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Car Fund</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/car.png" align="left" /> <h3>Car Fund</h3> <p>0</p>
			  <a href="<?php echo base_url();?>admin" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div>  -->
		
		
		<!-- <div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Travel Fund</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/travel.png" align="left" /> <h3>Travel Fund</h3> <p>0</p>
			  <a href="<?php echo base_url();?>admin" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div>  
		
		
		<div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Saving Fund</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/saving.png" align="left" /> <h3>Saving Fund</h3> <p>0</p>
			  <a href="<?php echo base_url();?>admin" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div>
		<div class="col-md-4">
          <div class="portlet" style="border-color:#292928;">
            <div class="portlet-header" style="background-color:#292928;"><h3 style="color:#FFFFFF">Healthcare Fund</h3></div> 
            <div class="portlet-content">
              <img src="<?php echo base_url(); ?>/assets/front/images/health.png" align="left" /> <h3>Healthcare Fund</h3> <p>0</p>
			  <a href="<?php echo base_url();?>admin" type="button" class="btn btn-success btn-sm bt">Go</a>
            </div> 
          </div> 
        </div> -->
		
		<!--div class="col-sm-12">
		<h2 style="margin-left: 500px;">Rewards</h2>
 <div class="table-responsive rwd">
<table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th style="background-color:#ED5922;"><center style="color:#FFFFFF">Work Commission</center></th><th style="background-color:#ED5922;"><center style="color:#FFFFFF">Reward</center></th></tr> </thead> 
<tbody> 
<tr <?php if($user['reward'] >=1 ) { echo  'class="reward"';  } else { $act = ''; } ?> >  
<td>100 PV</td>
<td>Microwave </td>
</tr>
<tr <?php if($user['reward'] >=2 ) { echo  'class="reward"';  } else { $act = ''; } ?>>  
<td>500 PV</td>
<td>LED TV</td>
</tr>
<tr <?php if($user['reward'] >=3 ) { echo  'class="reward"';  } else { $act = ''; } ?>>  
<td>1000 PV</td>
<td>Activa</td>
</tr>
<tr <?php if($user['reward'] >=4 ) { echo  'class="reward"';  } else { $act = ''; } ?>>  
<td>5000 PV </td>
<td>Sofa Set + Dinning + Bed</td>
</tr>
<tr <?php if($user['reward'] >=5 ) { echo  'class="reward"';  } else { $act = ''; } ?>>  
<td>15000 PV</td>
<td>Foreign Tour</td>
</tr>
<tr <?php if($user['reward'] >=6 ) { echo  'class="reward"';  } else { $act = ''; } ?>>  
<td>30000 PV</td>
<td>Swift Car</td>
</tr>
<tr <?php if($user['reward'] >=7 ) { echo  'class="reward"';  } else { $act = ''; } ?>>  
<td>60000 PV </td>
<td>3 BHK Flat</td>
</tr>



</tbody>
</table>
</div>
</div-->
		
		
		
		<div class="clearfix"></div>
		
      </div> <!-- /.row -->

<div style="clear:both"></div>		


    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container -->



