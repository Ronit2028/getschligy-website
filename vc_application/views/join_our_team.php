
	
		<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/join_our_tem.png" alt="Breadcrumbs Image">
                </div>
              
            </div>

			
			
			
		<div class="contact-page-section team pt-100 pb-100 md-pt-70 md-pb-70">
            	<div class="container">
            		
            		<div class="row align-items-center">
            			<div class="col-lg-6 md-mb-30">
            				<div class="contact-comment-box">
								<div class="inner-part">
                                    <h2 class="title mb-mb-15"><span>Good education </span>is foundation for better future</h2>
                                    <p>Getscholify is a collaborative platform revolutionizing the higher education in India. Our aim is to empower India by strengthening the youth with right education. We know that a revolution like this needs a strong team with likewise vision. We welcome those people who want to help us in this initiative. To be a part of Getscholify submit the form by filling your details our team will contact you.</p>
                                </div>
                            </div> 
            			</div>
            			<div class="col-lg-6 pl-60 md-pl-15">
			        		<div class="contact-comment-box">
			        			
			                    <div id="form-messages"></div>
			                    <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Great !</strong> Your request has been submitted successfully. We will get back to you soon.'; 
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
      
      echo form_open_multipart('join_our_team', $attributes);
      ?>

								<form  method="post" action="">
									<fieldset>
										<div class="row"> 

											<?php if($this->session->userdata('join_our_team_otp')!='') { ?>
		                                 <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
		                                    <input class="from-control" type="text"  name="otp" placeholder="Enter OTP" value="<?php if($this->input->post('otp')!='') { echo $this->input->post('otp'); } ?>" >
		                                </div>
                                		<?php } ?>
                                            <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" id="name" name="f_name" placeholder="First Name" required="" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } ?>">
                                            </div> 
											 <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" id="name" name="l_name" placeholder="Last Name" required="" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } ?>">
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone" required="" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } ?>">
                                            </div>											
                                            <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } ?>">
                                            </div>   
										</div>
										<div class="form-group mb-0">
											<input class="btn-send" type="submit" value="Submit Now">
										</div>

										 <?php if($this->session->userdata('join_our_team_otp')!='') { ?>
										 	<br>
                                        <div class="form-group mb-0">
                                    <input class="btn-send" type="submit" value="Resend OTP">
                                    </div>  
                            <?php } ?>								   
									</fieldset>
								</form>
			        		</div>
            			</div>
            		</div>
            	</div>
            </div>
			
			
			
			
			<!--<div class="rs-cta about">
                <div class="cta-img">
                    <img src="campus/assets/images/cta/cta-bg2.jpg" alt="">
                </div>
                <div class="cta-content text-center">
                    <div class="sec-title mb-40 sm-mb-20 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                        <h2 class="title white-color extra-bold mb-16 sm-mb-5">Our vision</h2>
                        <h2 class="sub-title capitalize white-color mb-0">We at Getscholify knows the role of education in the development of our country. Approximately, 20% of population in India is of (15 to 24) years of age, but only 27% attends college. We know that for the better growth of a country we should educate our youth first. That is why we have created a platform that offers scholarships to every student in India. Our Vision is to support the dreams of young Indians so that they can explore their field of interest and build a limitless career.</h2>
                    </div>
                   
                </div>
            </div>-->
			
			
			<!--<div class="rs-cta style2 about">
				<div class="partition-bg-wrap inner-page">
					<div class="container">
						<div class="row y-bottom">
							<div class="col-lg-6 pb-50 md-pt-50 md-pb-50">
								
							</div>
							<div class="col-lg-6 pl-62 pt-50 pb-50 md-pt-50 md-pb-50 md-pl-15">
								<div class="sec-title mb-40 md-mb-20">
										<h2 class="title mb-16">Our mission</h2>
										<div class="desc">Our Mission is to reinforce the youth of India with quality education. More than 2 million students every year quit their higher education because of a shortage of funds. Our mission is to help those students by providing them scholarships.</div>
										<div class="desc">Our mission is to unite the corporates, Colleges & students in a cooperative network. This network will keep supporting the needy students forever. With this vision, we aim to increase the percentage of students pursuing higher education in India, so that our nation becomes a land of excellence. We believe in  fulfilling the dreams of students by acting as a bridge between the willing donors and the deserving meritorious students.</div>
								</div>
								
							</div>
						</div>    
					</div>
				</div>
			</div>-->
			
			
			<!--<div class="rs-cta Ourcore home11-style SScholarship pt-100 pb-100 md-pt-70 md-pb-70">
                 <div class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                    <div class="container">
					<div class="sec-title mb-50 text-center">
							<h2 class="title mb-0">Our <span>core </span>values</h2>
							
						</div>
					<div class="content  text-center">
                         <div class="row rs-counter couter-area">
                                <div class="col-md-4 sm-mb-30">
                                    <div class="counter-item one">
										<div class="cta-img">
											<img src="campus/assets/images/cta/head.png" alt="">
										</div>
                                    </div>
									<h2>Discipline</h2>
                                </div>
							
                                <div class="col-md-4 sm-mb-30">
                                    <div class="counter-item two">
										<div class="cta-img">
											<img src="campus/assets/images/cta/dedication.png" alt="">
										</div>
                                    </div> 
									<h2>Dedication</h2>
                                </div>
								
                                <div class="col-md-4">
                                    <div class="counter-item three">
									<div class="cta-img">
										<img src="campus/assets/images/cta/iocn3.png" alt="">
									</div>
                                    </div>
									<h2>Honesty</h2>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>-->
			
			
			
			

