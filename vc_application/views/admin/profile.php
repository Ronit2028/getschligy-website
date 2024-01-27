<?php $this->load->view('includes/admin/sidebar'); ?>

<div class="container">
  <div class="content">
    <div class="content-container">
<div class="col-sm-12">
<?php 
$user = $profile[0]; 
?>
<h2 class="content-header-title">Welcome <?php echo ucfirst($this->session->userdata('full_name'));?></h2>

</div>
<div class="col-sm-12 right-bar">

<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Profile updated successfully.';
          echo '</div>';       
        } /*elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		}*/
      }
	  
	  if($user['var_status']=='no') { 
              echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your profile is under review please wait 2 working days';
          echo '</div>';
           }
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open_multipart(base_url().'admin/profile', $attributes);
      ?>
	  
		<input type="hidden" value="<?php echo $user['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $user['var_status']; ?>" name="var_status">

	

		 <div class="form-group col-sm-4">
            <label>Registration 	Code</label>
              <input type="text" class="form-control" readonly  name="bsacode" value="<?php echo $user['customer_id'];?>" >
          </div>
		  
		<div class="form-group col-sm-4">
            <label>upload Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="image" >
<input type="hidden" value="<?php echo $user['image']; ?>" name="image_old">
          </div>  
		  
		  <div class="form-group col-sm-4">
		  
<?php if($user['image'] !='') { echo '<img  src="'.base_url().'images/user/'.$user['image'].'" width="100">'; }else {echo '<img src="'.base_url().'images/user/green.png" width="100">';} ?>
</div>

 <div class="form-group col-sm-12">
 </div>

        <div class="form-group col-sm-4">
            <label>First Name</label>
              <input type="text" class="form-control"  name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $user['f_name']; } ?>" >
          </div>
        <div class="form-group col-sm-4">
            <label>Last Name</label>
              <input type="text" class="form-control"  name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } else { echo $user['l_name']; } ?>" >
          </div>

		  <div class="form-group col-sm-4">
            <label>Gender</label>
			<select class="form-control"  name="gender">
            <option value="Male">Male</option>
			<option <?php if($user['gender']=='Female') { echo 'selected="selected"'; } ?> value="Female">Female</option>
			</select>
          </div>
        <div class="form-group col-sm-4">
            <label>Date of Birth</label>
              <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="dob" value="<?php if($this->input->post('dob')!='') { echo $this->input->post('dob'); } else { echo $user['dob']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Phone</label>
              <input type="number" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $user['phone']; } ?>" >
          </div>
        <div class="form-group col-sm-4">
            <label>Email</label>
              <input type="email" class="form-control" readonly name="email" value="<?php echo $user['email']; ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
            <label>Address</label>
              <input type="text" class="form-control"  name="address" value="<?php if($this->input->post('address')!='') { echo $this->input->post('address'); } else { echo $user['address']; } ?>" >
          </div>
        <div class="form-group col-sm-2">
            <label>City</label>
              <input type="text" class="form-control"  name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } else { echo $user['city']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-2">
            <label>State</label>
              <input type="text" class="form-control"  name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } else { echo $user['state']; } ?>" >
          </div>
        <div class="form-group col-sm-2">
            <label>Pincode</label>
              <input type="number" class="form-control"  name="pincode" value="<?php if($this->input->post('pincode')!='') { echo $this->input->post('pincode'); } else { echo $user['pincode']; } ?>" >
          </div>
		  
		<!--  <div class="form-group col-sm-6">
            <label>PAN Card</label>
              <input type="text" class="form-control"  name="pancard" value="<?php //if($this->input->post('pancard')!='') { echo $this->input->post('pancard'); } else { echo $user['pancard']; } ?>" >
			  </div>
			  
		  <div class="form-group col-sm-4">
			    <label>PAN Proof</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="panimage" <?php //if($user['panimage']=='') { echo 'required=""'; } ?>>
			  <input type="hidden" value="<?php echo $user['panimage']; ?>" name="panimage_old">
			   
          </div>-->
		  <div class="form-group col-sm-2">
           <?php if($user['panimage'] !='') { echo '<a href="'.base_url().'images/user/'.$user['panimage'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['panimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>

        <div class="form-group col-sm-6">
            <label>Aadhar</label>
              <input type="text" class="form-control"  name="aadhar" value="<?php if($this->input->post('aadhar')!='') { echo $this->input->post('aadhar'); } else { echo $user['aadhar']; } ?>" >
			  </div>
		  <div class="form-group col-sm-4">
			   <label>Aadhar Proof</label>
              <input style="padding:0px;"  type="file" class="form-control" <?php //if($user['aadharimage']=='') { echo 'required=""'; } ?> name="aadharimage">
			  <input type="hidden" value="<?php echo $user['aadharimage']; ?>" name="aadharimage_old">
			  
          </div>
		  
		  <div class="form-group col-sm-2">
           <?php if($user['aadharimage'] !='') { echo '<a href="'.base_url().'images/user/'.$user['aadharimage'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['aadharimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
		  
		  
		<!--   <div class="form-group col-sm-4">
			   <label>Upload Aadhar Back</label>
              <input style="padding:0px;"  type="file" class="form-control" <?php //if($user['b_aadhar_img']=='') { echo 'required=""'; } ?> name="b_aadharimage">
			  <input type="hidden" value="<?php //echo $user['b_aadhar_img']; ?>" name="b_aadharimage_old">
          </div>-->
		  
		  
		  
		 <!-- <div class="form-group col-sm-2">
           <?php //if($user['b_aadhar_img'] !='') { echo '<a href="'.base_url().'images/user/'.$user['b_aadhar_img'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['b_aadhar_img'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div> -->
		  
		<!--   <div class="form-group  col-sm-12">
            <p><input type="checkbox" name="terms" checked required value="yes"> By clicking, you are agreeing to the privacy 
            policy and the terms & conditions of the Getscholify.
            </p>
          </div>-->
		  
		  
		 <!-- <h4 style="text-align:center;clear:both;padding-top:20px; color:#fe980f;">Enter Bank Details</h4>-->
		<!--<div class="col-sm-6 form-group"><label>Bank Name</label> <input required type="text" name="bank_name" value="<?php //if($this->input->post('bank_name')!='') { echo $this->input->post('bank_name'); }else { echo $user['bank_name']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>Branch</label> <input required type="text" name="branch" value="<?php //if($this->input->post('branch')!='') { echo $this->input->post('branch'); }else { echo $user['branch']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>City</label> <input required type="text" name="bank_city" value="<?php //if($this->input->post('bank_city')!='') { echo $this->input->post('bank_city'); }else { echo $user['bank_city']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>State</label> <input required type="text" name="bank_state" value="<?php //if($this->input->post('bank_state')!='') { echo $this->input->post('bank_state'); }else { echo $user['bank_state']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>Account Name</label> <input required type="text" name="account_name" value="<?php //if($this->input->post('account_name')!='') { echo $this->input->post('account_name'); }else { echo $user['account_name']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>Account Type</label> <input required type="text" name="account_type" value="<?php //if($this->input->post('account_type')!='') { echo $this->input->post('account_type'); }else { echo $user['account_type']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>Account No.</label> <input required type="number" name="account_no" value="<?php //if($this->input->post('account_no')!='') { echo $this->input->post('account_no'); }else { echo $user['account_no']; } ?>" class="form-control"></div>
    <div class="col-sm-6 form-group"><label>Confirm Account No.</label> <input required type="number" name="c_account_no" value="<?php //if($this->input->post('c_account_no')!='') { echo $this->input->post('c_account_no'); }else { echo $user['account_no']; } ?>" class="form-control"></div>
		<div class="col-sm-6 form-group"><label>IFSC Code</label> <input required type="text" name="ifsc" value="<?php //if($this->input->post('ifsc')!='') { echo $this->input->post('ifsc'); }else { echo $user['ifsc']; } ?>" class="form-control"></div>
		
		<div class="form-group col-sm-6">
            <label>Marital Status</label>
			<select class="form-control"  name="marital_status">
            <option value="Single">Single</option>
			<option <?php //if($user['marital_status']=='Married') { echo 'selected="selected"'; } ?> value="Married">Married</option>
			</select>
          </div>-->
		
		
	<!--	 <div class="form-group col-sm-6">
            <label>Nominee Name</label>
              <input type="text" class="form-control" required name="nominee_name" value="<?php //if($this->input->post('nominee_name')!='') { echo $this->input->post('nominee_name'); } else { echo $user['nominee_name']; } ?>" >
          </div>
      
		  <div class="form-group col-sm-6">
            <label>Nominee Relation</label>
              <select class="form-control"  name="nominee_relation">
            <option <?php if($user['nominee_relation']=='Father') { echo 'selected="selected"'; } ?> value="Father">Father</option>
			<option <?php if($user['nominee_relation']=='Mother') { echo 'selected="selected"'; } ?> value="Mother">Mother</option>
			<option <?php if($user['nominee_relation']=='Brother') { echo 'selected="selected"'; } ?> value="Brother">Brother</option>
			<option <?php if($user['nominee_relation']=='Daughter') { echo 'selected="selected"'; } ?> value="Daughter">Daughter</option>
			<option <?php if($user['nominee_relation']=='Sister') { echo 'selected="selected"'; } ?> value="Sister">Sister</option>
			<option <?php if($user['nominee_relation']=='Son') { echo 'selected="selected"'; } ?> value="Son">Son</option>
			<option <?php if($user['nominee_relation']=='Husband') { echo 'selected="selected"'; } ?> value="Husband">Husband</option>
			<option <?php if($user['nominee_relation']=='Wife') { echo 'selected="selected"'; } ?> value="Wife">Wife</option>
			<option <?php if($user['nominee_relation']=='Husband') { echo 'selected="selected"'; } ?> value="Husband">Husband</option>
			<option <?php if($user['nominee_relation']=='Other') { echo 'selected="selected"'; } ?> value="Other">Other</option>
			</select>
          </div>
		  
        <div class="form-group col-sm-6">
            <label>Nominee DOB</label>
              <input type="text" class="form-control" name="nominee_dob" value="<?php if($this->input->post('nominee_dob')!='') { echo $this->input->post('nominee_dob'); } else { echo $user['nominee_dob']; } ?>" >
          </div>  -->
		
		
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input required type="checkbox" name="declare" value="1"> I hereby declared that the details furnished above correct to the best of my knowledge and belief. </label></div>
		  
		  
		  
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Update</button> &nbsp;  
          </div>
		  
		  <?php echo form_close(); ?> 
		  
</div>
</div>
</div>
</div>
