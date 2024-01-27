	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/schlorship_reply'; ?>">Back</a>
        <h2> Updation </h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Updation successfully.';
          echo '</div>';       
        } elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
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
      
      echo form_open_multipart('admin/schlorship_reply/edit/'.$this->uri->segment(4).'', $attributes);
	 $user = $reply_id[0];
	
      ?>
        <fieldset>
		
		
		 <div class="form-group col-sm-4">
            <label>First Name</label>
              <input type="text" class="form-control"  name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $user['f_name']; } ?>" >
          </div>
		
		
		
		 <div class="form-group col-sm-4">
            <label>Last Name</label>
              <input type="text" class="form-control"  name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } else { echo $user['l_name']; } ?>" >
          </div>
		
		
		
		
		
		 <div class="form-group col-sm-4">
            <label>Phone No</label>
              <input type="text" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $user['phone']; } ?>" >
          </div>
		
		
		 <div class="form-group col-sm-4">
            <label>Email</label>
              <input type="text" class="form-control"  name="email" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } else { echo $user['email']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Pin Code</label>
              <input type="text" class="form-control"  name="pin_code" value="<?php if($this->input->post('pin_code')!='') { echo $this->input->post('pin_code'); } else { echo $user['pin_code']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>State</label>
              <input type="text" class="form-control"   name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } else { echo $user['state']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>City</label>
              <input type="text" class="form-control"  name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } else { echo $user['city']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Occupation</label>
              <input type="text" class="form-control"  name="occupation" value="<?php if($this->input->post('occupation')!='') { echo $this->input->post('occupation'); } else { echo $user['occupation']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Income</label>
              <input type="text" class="form-control"  name="income" value="<?php if($this->input->post('income')!='') { echo $this->input->post('income'); } else { echo $user['income']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Category</label>
              <input type="text" class="form-control"  name="category" value="<?php if($this->input->post('category')!='') { echo $this->input->post('category'); } else { echo $user['category']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Orphan</label>
              <input type="text" class="form-control"  name="orphan" value="<?php if($this->input->post('orphan')!='') { echo $this->input->post('orphan'); } else { echo $user['orphan']; } ?>" >
          </div>
		    <div class="form-group col-sm-4">
            <label>Qualification</label>
              <input type="text" class="form-control"  name="qualification" value="<?php if($this->input->post('qualification')!='') { echo $this->input->post('qualification'); } else { echo $user['qualification']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Passing year</label>
              <input type="text" class="form-control"   name="passing_year" value="<?php if($this->input->post('passing_year')!='') { echo $this->input->post('passing_year'); } else { echo $user['passing_year']; } ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Course</label>
              <input type="text" class="form-control"   name="course" value="<?php if($this->input->post('course')!='') { echo $this->input->post('course'); } else { echo $user['course']; } ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Grade</label>
              <input type="text" class="form-control"  name="grade" value="<?php if($this->input->post('grade')!='') { echo $this->input->post('grade'); } else { echo $user['grade']; } ?>" >
          </div>
 <div class="form-group col-sm-4">
            <label>Percentage</label>
              <input type="text" class="form-control"   name="percentage" value="<?php if($this->input->post('percentage')!='') { echo $this->input->post('percentage'); } else { echo $user['percentage']; } ?>" >
          </div>
		   <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status</label>
             <div class="col-sm-9">  <select name="status" class="form-control custom-select">
			  <option <?php if($user['status']=='Under Process') { echo 'selected="selected"'; } ?> value="Under Process">Under Process</option>
			  <option <?php if($user['status']=='Under Review') { echo 'selected="selected"'; } ?> value="Under Review">Under Review</option>
			  <option <?php if($user['status']=='Under Verification') { echo 'selected="selected"'; } ?> value="Under Verification">Under Verification</option>
			  <option <?php if($user['status']=='Disapproved') { echo 'selected="selected"'; } ?> value="Disapproved">Disapproved</option>
			  <option <?php if($user['status']=='Approved') { echo 'selected="selected"'; } ?> value="Approved">Approved</option>
			  <option <?php if($user['status']=='Pending') { echo 'selected="selected"'; } ?> value="Pending">Pending</option>
			  </select>
          </div> 
          </div> 
		
		
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/webstores'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>
  
  
  <script>
  
  
  $(document).ready(function() {
  $("#parent").click(function() {
    $(".child").prop("checked", this.checked);
  });

  $('.child').click(function() {
    if ($('.child:checked').length == $('.child').length) {
      $('#parent').prop('checked', true);
    } else {
      $('#parent').prop('checked', false); 
    }
  });
});
  
  jQuery('#loc').on('change',function(){
	 // alert();
        var locID = jQuery(this).val();
		
        if(locID){
           jQuery.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>index.php/vc_site_admin/pg/location',
                data:{l_id:locID},
                success:function(html){
                jQuery('#p_name').html(html);                   
                }
            }); 
        }else{
            jQuery('#p_name').html('<option value="">Select LOcation first</option>');
        } 

    }); 
  
  
  
  
  
  
  
  
  
  </script>
  
  
  
  
  
  
  
  