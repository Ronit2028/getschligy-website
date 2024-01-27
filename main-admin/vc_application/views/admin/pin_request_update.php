	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/wallet_request_list'; ?>">Back</a>
        <h2>Update Wallet Request</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Pin Request updated successfully.';
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
      
      echo form_open_multipart('admin/pin_request/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $category[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $prod['tr_pin']; ?>" name="tr_pin">
		<input type="hidden" value="<?php echo $prod['phone']; ?>" name="phone">
		
		 <div class="form-group col-sm-6">
            <label> Customer ID</label>
              <input type="text" readonly class="form-control"  name="bsacode" value="<?php echo $category[0]['customer_id'];?>" >
          </div>
		 <div class="form-group col-sm-6">
            <label> Amount</label>
              <input type="text" class="form-control"  name="subject" value="<?php echo $category[0]['amount'];?>" >
          </div>
		  <div class="form-group col-sm-6">
            <label> UTR No.</label>
              <input type="text" class="form-control"  name="neft" value="<?php echo $category[0]['neft'];?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
           <label class="control-label col-sm-6">Status<small style="color:red">*</small></label>
             <div class="col-sm-12">  <select name="status" class="form-control custom-select">
			   <option value="Pending">Pending</option>
         <option <?php if($category[0]['status']=='Approved'){ echo 'selected="selected"';}?>value="Approved">Approved </option>
			  <option <?php if($category[0]['status']=='Disapproved'){ echo 'selected="selected"';}?>value="Disapproved">Disapproved </option>
			  </select>
          </div> 
          </div>
		  
		<!--     <div class="form-group col-sm-6">
            <label> Account No.</label>
              <input type="text" class="form-control"  name="account_no" value="<?php echo $category[0]['account_no'];?>" >
          </div>
		  
		  
		  
		<div class="form-group col-sm-6">
            <label> Mobile No.</label>
              <input type="int" class="form-control"  name="phone" value="<?php echo $category[0]['phone'];?>" >
          </div>
		 
		  
		  	  
		    <div class="form-group col-sm-6">
            <label> Bank Name</label>
              <input type="text" class="form-control"  name="bank_name" value="<?php echo $category[0]['bank_name'];?>" >
          </div>
		  
		   <div class="form-group col-sm-6">
            <label>Bank branch</label>
              <input type="text" class="form-control"  name="bank_branch" value="<?php echo $category[0]['bank_branch'];?>" >
          </div>
		  
		   <div class="form-group col-sm-6">
		  
		   <div class="form-group col-sm-12">
            <label> IFSC Code</label>
              <input type="text" class="form-control"  name="ifsc" value="<?php echo $category[0]['ifsc_code'];?>" >
          </div>  -->
		  <div class="form-group col-sm-6">
            <label>Description</label>
              <textarea class="form-control"  name="description" ><?php echo $category[0]['comment'];?></textarea>
          </div>
	
		 <div class="form-group col-sm-6">
            <label>Image</label>
              </div>
		  
		 <!-- <div class="form-group col-sm-2">
<?php if($category[0]['image'] !='') { echo '<img src="'.base_url().'../assets/images/'.$category[0]['image'].'" width="50" height="50">'; } ?>
</div>-->


           <div class="form-group col-sm-2">
           <?php if($category[0]['image'] !='') { echo '<a href="'.base_url().'../assets/images/'.$category[0]['image'].'" target="_blank"><img src="'.base_url().'../assets/images/'.$category[0]['image'].'"  width="50" height="50"> View </a>'; } ?>
          </div> 
			    
		  
		    
		  
		  
		  
		  		  
		   
        
		  <div class="form-group  col-lg-12">
          <div class="form-group  col-lg-2">
            <button class="btn btn-primary" type="submit">Update</button> &nbsp; 
			 <!--<a class="btn btn-primary" href="<?php echo base_url().'admin/pin_request_list'; ?>">Cancel </a>-->
          </div>
		  
		    </div> 
		   
		  
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>