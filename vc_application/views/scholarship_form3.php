
	
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

			
			
			
		<div class="contact-page-section Scholarshipp team pt-100 pb-100 md-pt-70 md-pb-70">
            	<div class="container">
            		
            		<div class="row align-items-center">
            			<div class="col-lg-6 md-mb-30">
            				<div class="contact-comment-box">
								<div class="inner-part">
                                    <h2 class="title mb-mb-15"><span>Get access to </span></h2>
                                    <p>Scholarship alerts and updates</p>
                                    <p>Scholarship marching to your profile</p>
                                    <p>Personalized dashboard to check scholarship application status</p>
                                    <p>Regular scholarship newsletters</p>
                                </div>
                            </div> 
            			</div>
            			<div class="col-lg-6 pl-60 md-pl-15">
			        		<div class="contact-comment-box">
			        			<img src="campus/assets/images/breadcrumbs/scholarship3.png" alt="Breadcrumbs Image">
			                    <div id="form-messages"></div>
			                    <?php 

			                    $qualification = array('+2 Medical','+2 Non Medical','+2 Commerce','+2 Arts','Other');
			                    $grade = array('A','B','C','D');

			                    $course = array('Engineering','Pharmacy','Para-Medical','Business Management','Computer Application','Food Agriculture & forestry','Law','Hotel & Tourism Management','Education and Teaching','Dental','Mass Communication','Nursing');

			                    if($this->session->flashdata('flash_message')=='updated') {
			                    	echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Scholarship Form Submitted Successfully.</strong></div>';
			                    }

			                    $session = $this->session->userdata('scholarship');
			                    //echo '<pre>'; print_r($session); die();
			                    if(empty($session)) { $session = array(); }
			                    echo validation_errors(); ?>
								<form method="post" action="">
									<fieldset>
										<div class="row">
                                             <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <select class="from-control" type="text" name="qualification" required="">
													<option>Select Qualification</option>
													<?php foreach ($qualification as $value) {
														if($this->input->post('qualification')==$value) { $selected = 'selected'; }
														elseif(array_key_exists('qualification', $session) && $session['qualification']==$value) { $selected = 'selected'; }
														else { $selected = ''; }

														echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
													} ?>
													
												</select>
                                            </div> 
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text"  name="passing_year" placeholder="Passing Year" required="" value="<?php if($this->input->post('passing_year')!='') { echo $this->input->post('passing_year'); } elseif(array_key_exists('passing_year', $session)) { echo $session['passing_year']; } ?>">
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <select class="from-control" type="text" name="grade" required="">
													<option>Select Your Grade</option>
													<?php foreach ($grade as $value) {
														if($this->input->post('qualification')==$value) { $selected = 'selected'; }
														elseif(array_key_exists('grade', $session) && $session['grade']==$value) { $selected = 'selected'; }
														else { $selected = ''; }
														echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
													} ?>
												</select>
                                            </div>
											 <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" name="percentage" placeholder="Percentage" required="" value="<?php if($this->input->post('percentage')!='') { echo $this->input->post('percentage'); } elseif(array_key_exists('percentage', $session)) { echo $session['percentage']; } ?>">
                                            </div>

                                            
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <select class="from-control" type="text" name="course" required="">
													<option selected="" disabled="">Select Seeking Course</option>
													<?php foreach ($course as $value) {
														if($this->input->post('course')==$value) { $selected = 'selected'; }
														elseif(array_key_exists('course', $session) && $session['course']==$value) { $selected = 'selected'; }
														else { $selected = ''; }
														echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
													} ?>
													
												</select>
                                            </div>
										</div>
										<div class="form-group mb-0">
											<input class="btn-send" type="submit" value="Send">
										</div>										   
									</fieldset>
								</form>
			        		</div>
            			</div>
            		</div>
            	</div>
            </div>
			
			
			
			
			