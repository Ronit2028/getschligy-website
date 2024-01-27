	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/lamlord'; ?>">Back</a>
        <h2>Update Customer Incomes</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Customer updated successfully.';
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
      
      echo form_open_multipart('admin/lamlord/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $incomes[0];
      ?>
         <fieldset> 
		<div class="form-group col-sm-4">
            <label>Customer ID</label>
              <input type="text" class="form-control"  name="customer_id" value="<?php if($this->input->post('customer_id')!='') { echo $this->input->post('customer_id'); } else { echo $prod['customer_id']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Rank</label>
              <input type="text" class="form-control"  name="rank" value="<?php if($this->input->post('rank')!='') { echo $this->input->post('rank'); } else { echo $prod['rank']; } ?>" >
          </div>
		  
		<div class="form-group col-sm-4">
            <label>Package</label>
              <input type="text" class="form-control"  name="package" value="<?php if($this->input->post('package')!='') { echo $this->input->post('package'); } else { echo $prod['package']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Wallet</label>
              <input type="text" class="form-control"  name="wallet" value="<?php if($this->input->post('wallet')!='') { echo $this->input->post('wallet'); } else { echo $prod['bliss_amount']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-12">
            <label><h2>INCOMES</h2></label>
             
          </div>
		  
	
		  <div class="form-group col-sm-4">
            <label>Direct Sales</label>
              <input type="text" class="form-control"  name="direct_sale" value="<?php if($this->input->post('direct_sale')!='') { echo $this->input->post('direct_sale'); } else { echo $prod['direct_sale']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Team Performance</label>
              <input type="text" class="form-control"  name="team_performance" value="<?php if($this->input->post('team_performance')!='') { echo $this->input->post('team_performance'); } else { echo $prod['team_performance']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Education Fund</label>
              <input type="text" class="form-control"  name="education" value="<?php if($this->input->post('education')!='') { echo $this->input->post('education'); } else { echo $prod['education']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Team Sale Incentive</label>
              <input type="text" class="form-control"  name="team_sale_incentive" value="<?php if($this->input->post('team_sale_incentive')!='') { echo $this->input->post('team_sale_incentive'); } else { echo $prod['team_sale_incentive']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Travel</label>
              <input type="text" class="form-control"  name="travel" value="<?php if($this->input->post('travel')!='') { echo $this->input->post('travel'); } else { echo $prod['travel']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Entertainment</label>
              <input type="text" class="form-control"  name="entertainment" value="<?php if($this->input->post('entertainment')!='') { echo $this->input->post('entertainment'); } else { echo $prod['entertainment']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Repurchase</label>
              <input type="text" class="form-control"  name="repurchase" value="<?php if($this->input->post('repurchase')!='') { echo $this->input->post('repurchase'); } else { echo $prod['repurchase']; } ?>" >
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>Reward</label>
              <input type="text" class="form-control"  name="reward" value="<?php if($this->input->post('reward')!='') { echo $this->input->post('reward'); } else { echo $prod['reward']; } ?>" >
          </div>
		  
		  

		  


<div class="form-group col-sm-4">
           <label>Status<small style="color:red">*</small></label>
             <select name="status" class="form-control custom-select">
			  <option value="Active">Active</option> 
			  <option value="Deactive">Deactive</option>
			  </select> 
          </div> 

		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/lamlord'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>