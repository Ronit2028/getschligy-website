
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

			
			
			
		<div class="contact-page-section Scholarshipp team pt-50 pb-100 md-pt-70 md-pb-70">
            	<div class="container">
            		
            		<div class="row align-items-center">
            			<div class="col-lg-6 md-mb-30">
            				<div class="contact-comment-box">
								<div class="inner-part">
                                    <h2 class="title mb-mb-15"><span>Get access to </span></h2>
                                    <li>Scholarship alerts and updates</li>
                                    <li>Scholarship marching to your profile</li>
                                    <li>Personalized dashboard to check scholarship status</p>
                                    <li>Regular scholarship newsletters</li>
                                </div>
                            </div> 
            			</div>
            			<div class="col-lg-6 pl-60 md-pl-15">
			        		<div class="contact-comment-box">
			        			<img src="campus/assets/images/breadcrumbs/scholarship2.png" alt="Breadcrumbs Image">
			                    
								<div id="form-messages"></div>
								<?php
								$category = array('GENERAL','SC','ST','OBC','RBA','EWS','BC','EBC','OPEN','OTHERS'); 
								$session = $this->session->userdata('scholarship');
			                    if(empty($session)) { $session = array(); }
			                    //echo '<pre>'; print_r($session); echo '</pre>';
								echo validation_errors(); ?>
								<form method="POST" action="">
									<fieldset>
									
										<div class="row">
                                             <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" name="pin_code" placeholder="Area Pin Code" required="" value="<?php if($this->input->post('pin_code')!='') { echo $this->input->post('pin_code'); } elseif(array_key_exists('pin_code', $session)) { echo $session['pin_code']; } ?>">
                                            </div>
											 


                                            <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                               <select class="from-control" name="state" placeholder="" required="" id="constituency1">
													<option value="">Select State</option>
													<?php
													

													 foreach($states as $state) {
													 	if($this->input->post('state')==$state['name']) { $selected = 'selected'; }
														elseif(array_key_exists('state', $session) && $session['state']==$state['name']) { $selected = 'selected'; }
														else { $selected = ''; }
														if($selected!='') { 
															$cities = $this->customer_model->select_city($state['id']);
														}

														echo '<option '.$selected.' value="'.$state['id'].'~~'.$state['name'].'">'.$state['name'].'</option>';
													} ?>
												</select>
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                               <select class="from-control" name="city" placeholder="" required="" id="sub_constituency1">
													<option value="">Select State first</option>
													<?php 
														if(!empty($cities)) {
															foreach($cities as $city) {
																if($this->input->post('city')==$city['name']) { $selected = 'selected'; }
																elseif(array_key_exists('city', $session) && $session['city']==$city['name']) { $selected = 'selected'; }
																else { $selected = ''; }

																echo '<option '.$selected.' value="'.$city['name'].'">'.$city['name'].'</option>';
															}
														}
													?>
												</select>
                                            </div>
											
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <input class="from-control" type="text" name="occupation" placeholder="Father Occupation" required="" value="<?php if($this->input->post('occupation')!='') { echo $this->input->post('occupation'); } elseif(array_key_exists('occupation', $session)) { echo $session['occupation']; } ?>">
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
												<input class="from-control" type="text" name="income" placeholder="Family Annual Income" required="" value="<?php if($this->input->post('income')!='') { echo $this->input->post('income'); } elseif(array_key_exists('income', $session)) { echo $session['income']; } ?>">
                                            </div>
											<div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                                <select class="from-control" type="text" name="category" placeholder="" required="">
													<option>Select Category</option>
													<?php
													foreach($category as $cat) {
													 	if($this->input->post('category')==$cat) { $selected = 'selected'; }
														elseif(array_key_exists('category', $session) && $session['category']==$cat) { $selected = 'selected'; }
														else { $selected = ''; }

														echo '<option '.$selected.' value="'.$cat.'">'.$cat.'</option>';
													} ?>

													?>
												</select>
                                            </div>
											 <div class="col-lg-6 mb-35 col-md-6 col-sm-6 Specially">
                                             <input  <?php if($this->input->post('abled')=='Yes') { echo 'checked'; }
														elseif(array_key_exists('abled', $session) && $session['abled']=='Yes') { echo 'checked'; } ?> class="from-control" type="checkbox" name="abled" value="1" > 
                                             <label> Specially Abled</label> 
                                            </div>
											<div class="col-lg-6 mb-35 col-md-6 col-sm-6 Specially">
                                             
                                             <input <?php if($this->input->post('orphan')=='Yes') { echo 'checked'; }
														elseif(array_key_exists('orphan', $session) && $session['orphan']=='Yes') { echo 'checked'; } ?> class="from-control" type="checkbox" name="orphan" value="1" >
													<label>Orphan </label>								
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
			
		<script>
		
		
		 jQuery('#constituency1').on('change',function(){
        var countryID = jQuery(this).val();
        if(countryID){
           jQuery.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>index.php/page/sub_constituency',
                data:'term_id='+countryID,
                success:function(html){
                    jQuery('#sub_constituency1').html(html);                   
                }
            }); 
        }else{
            jQuery('#sub_constituency1').html('<option value="">Select constituency first</option>');
        }

    });
		
		
		
		
		
		
		
		
		
		
		
		
</script>		
			
		
			
			
			