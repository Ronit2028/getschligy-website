<?php $user = $profile[0]; ?>
<div class="mainbar no-print">  
<nav class="">
<div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar"> 
    <ul class="nav navbar-nav mainbar-nav"> 
	<li class="active"><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
	<li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> Home</a></li> 	
	<li><a href="<?php echo base_url();?>admin/profile"><i class="fa fa-user"></i> Profile</a></li>		
	<li><a href="<?php echo base_url();?>admin/password"><i class="fa fa-lock"></i> Change Password</a></li>
	<!-- <li><a href="<?php echo base_url();?>admin/order"><i class="fa fa-shopping-bag"></i> My Orders</a></li> -->



	<!--	<li class="dropdown navbar-profile">  
	<a class="dropdown-toggle" data-toggle="dropdown" href="" aria-expanded="false"><i class="fa fa-shopping-bag"></i>		  My Orders  <span class="caret"></span></a>  
	<ul class="dropdown-menu" role="menu">
	<li><a href="<?php echo base_url('admin/order');?>"><span>Orders</span>  </a>            </li>
<li>			<a href="<?php echo base_url('admin/pin_sale');?>"><span>Sale</span>  </a>			</li>


	</ul>   
	</li>

	<li class="dropdown navbar-profile">  
	<a class="dropdown-toggle" data-toggle="dropdown" href="" aria-expanded="false"><i class="fa fa-credit-card"></i>		  My Income  <span class="caret"></span></a>  
	<ul class="dropdown-menu" role="menu">
	<li><a href="<?php echo base_url('admin/income/Direct-Sales-Incentive');?>"><span>Direct Sales Incentive</span>  <strong><?php //echo $repurchase_income;?></strong></a>            </li>
<li>			<a href="<?php echo base_url('admin/income/Team-Sales-Incentive');?>"><span>Team Sales Incentives</span>  <strong></strong></a>			</li>

	<li><a href="<?php echo base_url('admin/income/Self-Sales-Incentive');?>"><span>Self Sales Incentives</span>  <strong></strong></a>			</li>

	
	<li><a href="<?php echo base_url('admin/rewards');?>"><span>Rewards</span>  <strong></strong></a></li>  
	</ul>   
	</li>
	<li><a href="<?php echo base_url();?>admin/DistributorLevelInformation"><i class="fa fa-info-circle"></i> Level Information</a></li>
	
	
	<li class="dropdown navbar-profile1">  
	<a class="dropdown-toggle" data-toggle="dropdown" href="" aria-expanded="false"><i class="fa fa-credit-card"></i>		  wallet <span class="caret"></span></a>  
	<ul class="dropdown-menu" role="menu">
	<li><a href="<?php echo base_url('admin/request-wallet');?>"><span>Load wallet</span>  <strong></strong></a>            </li>
<li>			<a href="<?php echo base_url('admin/transfer_fund');?>"><span>Transfer fund</span>  <strong></strong></a>			</li>

	
	<li><a href="<?php echo base_url('admin/transfer_history');?>"><span> Transfer history</span>  <strong></strong></a></li> 


 
<li><a href="<?php echo base_url('admin/Payment_request');?>"><span> Redeem Request</span>  </a></li>  -->
<!--	</ul>   
	</li>	 --->
	<li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-sign-out"></i>Logout</a></li>      
	</ul> 
    </div>  <!-- /.navbar-collapse -->
	</div> <!-- /.container --> 
	</nav>
	</div>