<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/aboutt2.png" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
                    <h1 class="page-title">Login</h1>
                    <ul>
                        <li>
                            <a class="active" href="http://campus4success.com">Home</a>
                        </li>
                        <li>Login</li> 
                    </ul>
                </div>
            </div>
			
			
	<section class="signin">
	<div class="container">

 <div class="fdr2 registerrr"> 

		

 <?php 
		 
      //flash messages
      if($this->session->flashdata('flash_message_l')){
        if($this->session->flashdata('flash_message_l') != '')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Registered successfully.!</strong> '.$this->session->flashdata('flash_message_l').'';
          echo '</div>';       
        } 
      }
	   
      
		echo validation_errors();

		?>
	<h1 class="mrgnn"> Login</h1>
	<div id="forget-msg-div"></div>
	<form action=""   method="POST">
		
		<p><label>Phone</label> <input type="text" required name="user_name" class="form-control" placeholder="Enter your Phone No."></p>
		<p><label>Password</label> <input type="password" required name="password" class="form-control" placeholder="Enter your Password"></p>
		 <input type="submit" class="btn btn-primary" name="submit" value="Login">
		<a href="<?php echo base_url(); ?>signup" class="btn btn-primary">Register</a>
		<a href="<?php echo base_url(); ?>forgetpassword" class="Forgotten">Forgotten Your Password?</a>
		
		
		<div class="google_log">
		<h2>or Sign Up With</h3>	
			<a href=""><img src="<?php echo base_url(); ?>assets/front/images/faceb.png"></a>
			<a href="<?php echo base_url(); ?>google_login"><img src="<?php echo base_url(); ?>assets/front/images/googleeee.png"></a>
		</div>
		
		
	 
<!--	 <p class="text-center googl">OR<span class="svn svn1"><a  href="<?php echo base_url(); ?>google_login"><img src="<?php echo base_url(); ?>assets/front/images/goo.png"> Continue With Google </a></span></p>   -->

</form>
</div>
</div>
</section>