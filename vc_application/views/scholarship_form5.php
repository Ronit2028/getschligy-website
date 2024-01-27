
	
		<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/Scholarship3.png" alt="Breadcrumbs Image">
                </div>
               <div class="breadcrumbs-text white-color">
                    <h1 class="page-title">Scholarship Form</h1>
                    <ul>
                        <li>Quantity and persistence will get you the outcomes you need.</li>
                    </ul>
                </div>
            </div>

			
			
			
		<div class="contact-page-section team pt-100 pb-100 md-pt-70 md-pb-70">
            	<div class="container">  
            		
            		<div class="row align-items-center">
            			<div class="col-lg-6 md-mb-30">
            				<div class="contact-comment-box">
								<div class="inner-part Scholarshipppp">
                                    <h2 class="title mb-mb-15"><span>Get access to </span></h2>
                                    <p>Scholarship alerts and updates</p>
                                    <p>Scholarship marching to your profile</p>
                                    <p>Personalized dashboard to check scholarship application status</p>
                                    <p>Regular scholarship newsletters</p>
                                </div>
                            </div> 
            			</div>
            			<div class="col-lg-6 pl-60 md-pl-15">
			        		<div class="contact-comment-box Register">
									
										<div class="inner-part">
											<p>Apply For Schlorship</p>
                               
										</div> 
			                    <div id="form-messages"></div>
			                    <?php 

			                    if($this->session->flashdata('flash_message')=='updated') {
			                    	echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Scholarship Form Submitted Successfully.</strong></div>';
			                    }
			                    
			                    $session = $this->session->userdata('scholarship');
			                    //echo '<pre>'; print_r($session); die();
			                    if(empty($session)) { $session = array(); }
			                    echo validation_errors(); ?>
								<form  method="POST" action="">
									<fieldset>    
										<div class="row">
											<!--<div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                                <a href="javascript:;"><img src="campus/assets/images/breadcrumbs/facebook_button.jpg" alt="Breadcrumbs Image"></a>
                                            </div>-->
											<!--<div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                                <a href="javascript:;"><img src="campus/assets/images/breadcrumbs/google_button.jpg" alt="Breadcrumbs Image"></a>
                                            </div>-->
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" name="f_name" placeholder="Student First Name" required="" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } elseif(array_key_exists('f_name', $session)) { echo $session['f_name']; } else { echo $profile[0]['f_name']; }  ?>">
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" name="l_name" placeholder="Student Last Name" required="" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } elseif(array_key_exists('l_name', $session)) { echo $session['l_name']; } else { echo $profile[0]['l_name']; }  ?>">
                                            </div> 
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" name="phone" placeholder="Phone No." required="" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } elseif(array_key_exists('phone', $session)) { echo $session['phone']; } else { echo $profile[0]['phone']; }  ?>">
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="email" name="email" placeholder="Email" required="" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } elseif(array_key_exists('email', $session)) { echo $session['email']; } else { echo $profile[0]['email']; }  ?>">
                                            </div>
											
										</div>
										<div class="form-group mb-0">
											<input class="btn-send" type="submit" value="Next">
										</div>										   
									</fieldset>
								</form>
			        		</div>
            			</div>
            		</div>
            	</div>
            </div>
			
			
			
			
		
			
			
			
			