      <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/feedback'; ?>">Back</a>
        <h2>Update Grievance</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Grievance updated successfully.';
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
	  //print_r($category);
      
      echo form_open_multipart('admin/feedback/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $feedback[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $prod['tr_pin']; ?>" name="tr_pin">
		<input type="hidden" value="<?php echo $prod['phone']; ?>" name="phone">
		
		
		<div class="form-group col-sm-6">
            <label>Customer ID</label>
              <input type="text" readonly class="form-control"  name="name" value="<?php echo $prod['name'];  ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
            <label>email</label>
              <input type="text" readonly class="form-control"  name="email" value="<?php echo $prod['email'];  ?>" >
          </div>
		 
		 <div class="form-group col-sm-6">
            <label>subject</label>
              <input type="text" readonly class="form-control"  name="subject" value="<?php echo $prod['subject'];  ?>" >
          </div>
		  	  
		   <div class="form-group col-sm-12">
            <label>message</label>
              <textarea class="form-control"  name="message" ><?php if($this->input->post('message')!='') { echo $this->input->post('message'); } else { echo $prod['message']; } ?></textarea>
          </div>
		  
		  <div class="form-group col-sm-12">
            <label>Reply</label>
              <textarea class="form-control"  name="reply" ><?php if($this->input->post('reply')!='') { echo $this->input->post('reply'); } else { echo $prod['reply']; } ?></textarea>
          </div>
		  
		<div class="form-group col-sm-6">         
		  <label>Status <small style="color:red">*</small></label>    
		  <select name="status" class="form-control custom-select">			
		  <option value="active">Active</option>		
		  <option <?php if($prod['status']=='rejected') { echo 'selected="selected"'; } ?> value="rejected">Rejected</option>		
		  <option <?php if($prod['status']=='accepted') { echo 'selected="selected"'; } ?> value="accepted">Accepted</option>		
		  </select>      
		  </div> 
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/feedback'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>