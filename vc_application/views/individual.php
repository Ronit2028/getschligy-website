


		<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/indiv.png" alt="Breadcrumbs Image">
                </div>
               <div class="breadcrumbs-text white-color">
			   <a href="#">
                    <h1 class="page-title"> Individual</h1>
					</a>
                    <ul>
                        <li>Be educated, be a good achiever</li>
                    </ul>
                </div>
            </div> 
			
		
      
		<div class="contact-page-section md-pt-70 md-pb-70 indiv">
				 <div class="rs-quick-contact">
                       <div id="form-messages"></div>
                         <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Request Sent successfully.'; 
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
      
      //print_r($restaurants);
      ?>
       <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
      //print_r($editor);
      
      echo form_open_multipart('individual', $attributes);
      ?>
                        <form method="post" action="">
                            <div class="row">

                                <?php if($this->session->userdata('individual_otp_number')!='') { ?>
                                 <div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="otp" placeholder="Enter OTP" value="<?php if($this->input->post('otp')!='') { echo $this->input->post('otp'); } ?>" >
                                </div>
                                <?php } ?>
                                <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                   <select class="from-control" name="currency" placeholder="" required>
										<option value="" selected>SELECT CURRENCY*</option>
										<option <?php if($this->input->post('currency')=='INDIAN RUPEE (INR)') { echo 'checked'; } ?> value="INDIAN RUPEE (INR)">INDIAN RUPEE (INR)</option>
										<option <?php if($this->input->post('currency')=='UNITED STATES DOLLAR (USD)') { echo 'checked'; } ?> value="UNITED STATES DOLLAR (USD)">UNITED STATES DOLLAR (USD)</option>				
									</select>
                                </div>
								<div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="amount" placeholder="Amount*" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); } ?>" >
                                </div>
								<div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text" name="cname" placeholder="Name*" value="<?php if($this->input->post('cname')!='') { echo $this->input->post('cname'); } ?>">
                                </div>
                                <div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="email" placeholder="Email*" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } ?>">
                                </div>   
                                <div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="phone" placeholder="Phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } ?>">
                                </div>   
                                
                                <div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="address" placeholder="Address*" value="<?php if($this->input->post('address')!='') { echo $this->input->post('address'); } ?>">
                                </div> 
								<div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="city" placeholder="City/Town*" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } ?>">
                                </div> 
								
								<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
									<p>Choose your Nationality*</p>
                                   <select class="from-control" name="state" required placeholder="">
									<option value="">Select Country</option>
									<option <?php if($this->input->post('state')=='India') { echo 'checked'; } ?> value="India">India</option>
									<option <?php if($this->input->post('state')=='United States') { echo 'checked'; } ?> value="United States">United States</option>				
									</select>
                                </div>
								<div class="col-lg-12 mb-35 col-md-12">
                                    <input class="from-control" type="text"  name="pan" placeholder="Pan No*" value="<?php if($this->input->post('pan')!='') { echo $this->input->post('pan'); } ?>">
                                <p>(Please note that tax exemption as per law is only available if PAN is quoted)</p><br>
								<h6>No refunds will be entertained  after the  instant tax exemption has been issued.</h6>
								</div>
								
								
                            </div>
                            <div class="form-group mb-0">
                                <input class="btn-send" type="submit" value="Submit Now">
                                    
                            </div> 

                            <br>
                                
                                    <?php if($this->session->userdata('individual_otp_number')!='') { ?>
                                        <div class="form-group mb-0">
                                    <input class="btn-send" type="submit" value="Resend OTP">
                                    </div>  
                                   <?php } ?>
                                
                        </form>
                   </div> 
				   
            </div>
			
			

  
			
			
			
			
			
			
			
			
			