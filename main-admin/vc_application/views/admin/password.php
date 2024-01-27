
<div class="page-heading">

<h2>Update Password</h2>

</div>
<div class="col-sm-12">
<br>
<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'password')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Password updated successfully.';
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
      echo form_open(base_url().'admin/password', $attributes);
      ?>
	  
	  <fieldset> 
	  
<input type="hidden" name="old_password_validate">
	

		 <div class="form-group col-sm-12">
            <label>Current Password:</label>
             <input type="password" name="old_password" placeholder="Current Password" required class="form-control">
          </div>

        <div class="form-group col-sm-12">
            <label>New Password:</label>
			<input type="password" name="newpassword" placeholder="New Password" required class="form-control" value="<?php if($this->input->post('newpassword')!='') { echo $this->input->post('newpassword'); } ?>">
			
          </div>
        <div class="form-group col-sm-12">
            <label>Retype New Password:</label>
			
			<input type="password" name="Retype_password" placeholder="Retype New Password" required class="form-control"
			value="<?php if($this->input->post('Retype_password')!='') { echo $this->input->post('Retype_password'); } ?>">
			
          </div>

          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" name="update" value="update" type="submit">Update</button> &nbsp;  
          </div>
		  
		  </fieldset> 
		  <?php echo form_close(); ?>
		  
</div>

