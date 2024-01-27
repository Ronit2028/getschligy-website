<?php $this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
<div class="container">
  <div class="content">
  <div class="content-container">
    	  <div>
		<h2 class="content-header-title text-center">Total Income : <?php echo round($total_income,2); ?> </h2>
		<?php // echo "<pre>"; print_r($team_performance_share); echo "</pre>"; ?>
      </div>
      <br>
     <!-- <div class="row">
        <div class="col-sm-12 col-md-12 hide">
		  <strong>My Sponsor</strong> Administrator ()! 
		  <strong>My Upline</strong> Administrator ()!
		   </a>
		</div>
        <div class="col-sm-6 col-md-4">
          <div class="row-stat">
            <p class="row-stat-label">Total Company RPV (<?php echo $total_company_lpv[0]['total_company_lpv']; ?>)</p>
            <h3 class="row-stat-value"><i class="fa fa-group"></i> </h3><br />
            <span class="label label-success row-stat-badge"> Total  <?php echo $total_company_lpv[0]['total_company_lpv']; ?> </span>
          </div>
        </div>
		<?php echo $total_associate_member; ?>
        <div class="col-sm-6 col-md-4">
          <div class="row-stat">
            <p class="row-stat-label">Total New RPV (<?php echo $total_member_lpv[0]['total_company_lpv']; ?>)</p>
            <h3 class="row-stat-value"><i class="fa fa-sitemap"></i> </h3><br />
            <span class="label label-success row-stat-badge"> Total <?php echo $total_member_lpv[0]['total_company_lpv']; ?> </span>
			
          </div>
        </div> 
		
		
        <div class="col-sm-6 col-md-4">
          <div class="row-stat">
 			<p class="row-stat-label">Profile</p>
			<div class="portlet-content1">
			
			<ul>
			<li><b>ID </b></li>
			 <li><b>Grade </b></li>
			 <li><b>Rank </b></li>
			 </ul>
            </div>       
			</div> 
        </div> 
      </div> row -->
  
    <div class="content-container">

<div class="row">



<div class="col-md-4">
          <div class="portlet" style="border-color:#4D4D4D;">
            <div class="portlet-header" style="background-color:#4D4D4D;"><h3 style="color:#FFFFFF">Self Sales Incentive
</h3></div> <!-- /.portlet-header -->
            <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/front/images/Direct Sales.png" align="left" /> 
      <p class="inc"><?php if(!empty($self_sale_incentive[0]['amount'])) {  echo round($self_sale_incentive[0]['amount'],2); }
else { echo 0; }      ?></p>  <a href="<?php  echo base_url('admin/income/Self-Sales-Incentive');?>" type="button" class="btn btn-success btn-sm" >View Details</a>
            </div> <!-- /.portlet-content -->
          </div> <!-- /.portlet -->
        </div>

<div class="col-md-4">
          <div class="portlet" style="border-color:#4D4D4D;">
            <div class="portlet-header" style="background-color:#4D4D4D;"><h3 style="color:#FFFFFF">Direct Sales Incentive
</h3></div> <!-- /.portlet-header -->
            <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/front/images/Direct Sales.png" align="left" /> 
			<p class="inc"><?php if(!empty($direct_sale_incentive[0]['amount'])) {  echo round($direct_sale_incentive[0]['amount'],2); }
else { echo 0; }			?></p>  <a href="<?php  echo base_url('admin/income/Direct-Sales-Incentive');?>" type="button" class="btn btn-success btn-sm" >View Details</a>
            </div> <!-- /.portlet-content -->
          </div> <!-- /.portlet -->
        </div>
		
		<div class="col-md-4">
          <div class="portlet" style="border-color:#4D4D4D;">
            <div class="portlet-header" style="background-color:#4D4D4D;"><h3 style="color:#FFFFFF">Team Sale Incentive</h3></div> <!-- /.portlet-header -->
            <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/front/images/Repurchase.png" align="left" /><p class="inc"><?php if(!empty($team_sale_incentive[0]['amount'])) { echo round($team_sale_incentive[0]['amount'],2); }
else { echo 0; }			?></p><a href="<?php echo base_url('admin/income/Team-Sales-Incentive');?>" type="button" class="btn btn-success btn-sm" >View Details</a>
            </div> <!-- /.portlet-content -->
          </div> <!-- /.portlet -->
        </div>
		<!--
 <div class="col-md-4">
          <div class="portlet" style="border-color:#4D4D4D;">
            <div class="portlet-header" style="background-color:#4D4D4D;"><h3 style="color:#FFFFFF">Rewards</h3></div>
            <div class="portlet-content">
            <img src="<?php echo base_url(); ?>/assets/front/images/Reward.png" align="left" /><p class="inc">0</p><a href="<?php echo base_url('admin/income/round-table');?>" type="button" class="btn btn-success btn-sm" >View Details</a>
            </div> 
          </div> 
        </div>  -->
		
</div>
</div>
</div>
</div>
