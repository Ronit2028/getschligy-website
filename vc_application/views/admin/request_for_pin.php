	<?php $this->load->view('includes/admin/sidebar'); ?>
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
	 <div class="container">
	  <div class="content">
		<div class="content-container">
      <div class="page-heading">
        <h2>Load Wallet</h2>
      </div>

     
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open_multipart('admin/request-wallet', $attributes);
      ?>
       
	   
	    <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong>  Request Sent successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
		 
		  <div class="form-group col-sm-6">
            <label> Amount<span style="color:red;"> *</span></label>
              <input type="number" class="form-control"  name="subject" value="<?php if($this->input->post('subject')!='') { echo $this->input->post('subject'); }  ?>" >
          </div>
		 <!-- <div class="form-group col-sm-6">
            <label> Mobile No.</label>
              <input type="int" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); }  ?>" >
          </div>  -->
		   <div class="form-group col-sm-6">
            <label> UTR No.<span style="color:red;"> *</span></label>
              <input type="text" class="form-control"  name="neft" value="<?php if($this->input->post('neft')!='') { echo $this->input->post('neft'); }  ?>" >
          </div>
		  
		   <div class="form-group col-sm-6">
            <label> Upload File<span style="color:red;"> *</span></label>
              <input type="file" required class="form-control"  name="uplode" value="<?php if($this->input->post('ifsc')!='') { echo $this->input->post('ifsc'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
            <label>Description</label>
              <textarea class="form-control"  name="description" value="<?php if($this->input->post('description')!='') { echo $this->input->post('description'); } ?>" ></textarea>
          </div>
		  
		  
		<!--   <div class="form-group col-sm-6">
            <label> Bank Name</label>
              <input type="text" class="form-control"  name="bank_name" value="<?php if($this->input->post('bank_name')!='') { echo $this->input->post('bank_name'); }  ?>" >
          </div> -->
		<!--   <div class="form-group col-sm-6">
            <label>Bank branch</label>
              <input type="text" class="form-control"  name="bank_branch" value="<?php if($this->input->post('bank_branch')!='') { echo $this->input->post('bank_branch'); }  ?>" >
          </div> -->
		   <div class="form-group col-sm-6">
        <!--    <label> Account No.</label>
              <input type="text" class="form-control"  name="account_no" value="<?php if($this->input->post('account_no')!='') { echo $this->input->post('account_no'); }  ?>" >
          </div>-->
		  
		 
		  
		  <div class="form-group col-lg-12 col-mg-12 col-sm-12">
            <label>Amount Credited In :- </label>
			 <p class="text-left"><b>Company Name :</b> STAKE IN TRADE VENTURES PRIVATE LIMITED</p>
             <p class="text-left"><b>Bank Name :</b> INDUSIND BANK</p>
             <p class="text-left"><b>Account No. :</b> 201008967900</p>
             <p class="text-left"><b>IFSC Code :</b> INDB0000732</p>
        <!--     <p class="text-left"><b>Account Type :</b> </p>     -->
             <p class="text-left"><b>Branch :</b> SCO-675</p>
             <p class="text-left"><b>Branch Address :</b> 70 SAS NAGAR MOHALI PUNJAB.</p>
             <p class="text-left"><b>Pin Code :</b> 160070</p>
              
          </div> 
		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Send Request</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pin_request'; ?>">Cancel </a>
          </div>
		  </div> 
		  
		  

      <?php echo form_close(); ?>
	  
	  </div>
	  </div>
	  </div>
	  
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>