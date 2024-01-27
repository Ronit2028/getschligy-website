<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/aboutt2.png" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
                    <h1 class="page-title">Sign up</h1>
                    <ul>
                        <li>
                            <a class="active" href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Sign up</li>
            </ul>
    </div>
</div>
			
			
	<section class="signin signup1">
 <div class="container">
	  

<div class="registerrr signup-sect sng-up" >
<div class="sec-title text-center mb-30">
    <h2 class="title mb-10">Create New Accountt</h2>
</div>
						
						
						
<?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Registered successfully.';
          echo '</div>';       
        }

        elseif($this->session->flashdata('flash_message') == 'otp')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'OTP sent to your email or phone.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	   
      ?>
 <?php 
      //form validation
      echo validation_errors(); 
      ?>
	  
	   <div id="register-msg-div"></div>
        <form class="form" action="" method="post">
		<?php if($this->session->userdata('otp_number')!='') { ?>
			<p><label>OTP</label>  
	   	<input type="text" name="otp" class="form-control input-empty" value="<?php if($this->input->post('otp')!='') { echo $this->input->post('otp'); } ?>"></p>
		<?php } ?>
       

	   <p><label>First Name</label>  
	   <input type="text" name="f_name" required class="form-control input-empty" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } ?>"></p>
       <p><label>Last Name</label> 
	   <input type="text" name="l_name" required class="form-control input-empty" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } ?>"></p>
       <p><label>Email</label>
	   <input type="email" name="email" required class="form-control input-empty" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } ?>"></p>
       <p><label>Password</label> 
	   <input type="password" name="pass_word" required class="form-control input-empty" value="<?php if($this->input->post('pass_word')!='') { echo $this->input->post('pass_word'); } ?>"></p>
	   <p><label>Confirm Password</label> 
	   <input type="password" name="c_password"  required class="form-control input-empty" value="<?php if($this->input->post('c_password')!='') { echo $this->input->post('c_password'); } ?>"></p>
       <p><label>Phone</label> 
	   <input type="number" min="1" maxlength="10" required name="phone" class="form-control input-empty" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } ?>"></p>
	   
	   
	    <!-- <p style="float: right;">
	<input id="check_box" type="checkbox" name="box" value="month">
	     Don't Have Referral Code	 
		 
	  </p>
	   
	    <p><label> Referral Code</label> 
	  <input id="bliss_code_input" type="text" name="referral_code" class="form-control input-empty request-code-input" value="<?php if($this->input->post('referral_code')!='') { echo $this->input->post('referral_code'); } ?>" ></p> -->
	  
	  <div id="sponsr_name"></div>
		  	<div class="form-group chek">
		 <input  name="term_condition" value="left" type="checkbox"><span class="check" style="color:#2e2e2e;"> I acknowledge that I have read, understood and agree to all the <a href="<?php echo base_url(); ?>#" target="_blank" style="cursor:pointer;">Terms & Conditions.</a></span>
		 </div>   
			 
		    <div class="request-code-div" style="display:none;">
			<div id="request-code-result"></div>
			<div class="input-group">
               <input type="text" class="form-control" maxlength="10" placeholder="Phone" value="">
               <div class="input-group-addon request-code-search glyphicon glyphicon-search"></div>
            </div>
			</div>
       <p><input type="submit" name="submit" value="Register Now" class="btn btn-primary popup-register-button">
       	<?php if($this->session->userdata('otp_number')!='') { ?>
       	<input type="submit" name="submit" value="Resend OTP" class="btn btn-primary popup-register-button">
       <?php } ?>

       <a href="<?php echo base_url(); ?>signin" class="btn btn-primary">Login</a> </p>
	
     
		<div class="google_log">
		<h2>or Sign Up With</h3>	
			<a href=""><img src="<?php echo base_url(); ?>assets/front/images/faceb.png"></a>
			<a href="<?php echo base_url(); ?>google_login"><img src="<?php echo base_url(); ?>assets/front/images/googleeee.png"></a>
		</div>
	 
	 
	 </form>
	 
	 </div>
	 
	 
	 
	  </div>
	  </section>
	 
	 