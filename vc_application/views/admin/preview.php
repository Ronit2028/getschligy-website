<?php $this->load->view('includes/admin/sidebar'); ?>


<div class="container">
  <div class="content">
    <div class="content-container">
<div class="col-sm-12">
<?php 
$user = $scholarship[0]; 
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
	  
	 
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
     echo form_open_multipart('admin/preview/'.$this->uri->segment(3).'', $attributes);
      ?>
	  
	
		
 <div class="form-group col-sm-12">
 </div>

        <div class="form-group col-sm-4">
            <label>Phone No</label>
              <input type="text" class="form-control" readonly name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $user['phone']; } ?>" >
          </div>
        <div class="form-group col-sm-4">
            <label>Email</label>
              <input type="text" class="form-control" readonly name="email" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } else { echo $user['email']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Pin Code</label>
              <input type="text" class="form-control" readonly name="pin_code" value="<?php if($this->input->post('pin_code')!='') { echo $this->input->post('pin_code'); } else { echo $user['pin_code']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>State</label>
              <input type="text" class="form-control"  readonly name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } else { echo $user['state']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>City</label>
              <input type="text" class="form-control" readonly name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } else { echo $user['city']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Occupation</label>
              <input type="text" class="form-control" readonly name="occupation" value="<?php if($this->input->post('occupation')!='') { echo $this->input->post('occupation'); } else { echo $user['occupation']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Income</label>
              <input type="text" class="form-control" readonly name="income" value="<?php if($this->input->post('income')!='') { echo $this->input->post('income'); } else { echo $user['income']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Category</label>
              <input type="text" class="form-control" readonly name="category" value="<?php if($this->input->post('category')!='') { echo $this->input->post('category'); } else { echo $user['category']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Orphan</label>
              <input type="text" class="form-control" readonly name="orphan" value="<?php if($this->input->post('orphan')!='') { echo $this->input->post('orphan'); } else { echo $user['orphan']; } ?>" >
          </div>
		    <div class="form-group col-sm-4">
            <label>Qualification</label>
              <input type="text" class="form-control" readonly name="qualification" value="<?php if($this->input->post('qualification')!='') { echo $this->input->post('qualification'); } else { echo $user['qualification']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Grade</label>
              <input type="text" class="form-control" readonly name="course" value="<?php if($this->input->post('course')!='') { echo $this->input->post('course'); } else { echo $user['course']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Passing year</label>
              <input type="text" class="form-control"  readonly name="passing_year" value="<?php if($this->input->post('passing_year')!='') { echo $this->input->post('passing_year'); } else { echo $user['passing_year']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Grade</label>
              <input type="text" class="form-control" readonly name="grade" value="<?php if($this->input->post('grade')!='') { echo $this->input->post('grade'); } else { echo $user['grade']; } ?>" >
          </div>
 <div class="form-group col-sm-4">
            <label>Percentage</label>
              <input type="text" class="form-control"  readonly name="percentage" value="<?php if($this->input->post('percentage')!='') { echo $this->input->post('percentage'); } else { echo $user['percentage']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Status</label>
              <input type="text" class="form-control"  readonly name="status" value="<?php if($this->input->post('status')!='') { echo $this->input->post('status'); } else { echo $user['status']; } ?>" >
          </div>
		  
		  
		  
		  
		  
		  		 <div class="form-group col-sm-6">
            <label  class="control-label">Request For Edit</label>
               <textarea class="form-control " name="message"><?php if($this->input->post('message')!='') { echo $this->input->post('message'); } ?></textarea>
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
		 

		  
	
	
		
	
		
		
	
		  
		  
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Update</button> &nbsp;  
          </div>
		  
		  <?php echo form_close(); ?> 
		  
</div>
</div>
</div>
</div>
