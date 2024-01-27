<?php ?>	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 .iod ul{float:right}
	 .iods ul{float:right}
	 .iods{background:#ccc}
	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}
	 input[type="file"]{padding:0px;} 
	 </style>
	 <?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart('admin/docverification/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $docverificationupdate[0];
	 // echo "<pre>"; print_r($prod); echo "</pre>";
	  ?>
      <div class="page-heading"> 
        <h2 class="iod">Update Document Verification <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/docverification'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Doc. verification updated successfully.';
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
	   
      ?>
      
      <?php 
      //form validation
      echo validation_errors(); 
      ?>
        
		
		<div id="collapse0" class="panel-collapse collapse in">
		 <input type="hidden" class="form-control" required name="rid" value="<?php echo $prod['id'];  ?>" >
	  
	  <div class="col-sm-12">
	 
	  
		<h4><strong>Aadhaar No. : </strong> <?php echo $prod['aadhar'];?></h4>
		  
		  <div class="form-group col-sm-6">
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Aadhar image <small style="color:red"></small></label>
             <div class="col-sm-9">   
			 <?php if($prod['aadharimage'] !='') { echo '<a href="'.base_url().'../images/user/'.$prod['aadharimage'].'" target="_blank"><img src="'.base_url().'../images/user/'.$prod['aadharimage'].'" style="width:auto;max-width:250px;"></a>'; } ?>
          </div>
          </div>
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Aadhar image Back<small style="color:red"></small></label>
             <div class="col-sm-9">   
			 <?php if($prod['b_aadhar_img'] !='') { echo '<a href="'.base_url().'../images/user/'.$prod['b_aadhar_img'].'" target="_blank"><img src="'.base_url().'../images/user/'.$prod['b_aadhar_img'].'" style="width:auto;max-width:250px;"></a>'; } ?>
          </div>
          </div>
		  
		  <h4><strong>PAN No. : </strong> <?php echo $prod['pancard'];?></h4>
		  
		 <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">PAN image <small style="color:red"></small></label>
             <div class="col-sm-9">   
			 <?php if($prod['panimage'] !='') { echo '<a href="'.base_url().'../images/user/'.$prod['panimage'].'" target="_blank"><img src="'.base_url().'../images/user/'.$prod['panimage'].'" style="width:auto;max-width:250px;"></a>'; } ?>
          </div>
          </div>
		
		</div>
		
		<div class="col-sm-6">
		<h4><strong>Customer Id : </strong> <?php echo $prod['customer_id'];?></h4>
		<h4><strong>Name : </strong> <?php echo $prod['f_name'];?></h4>
		<h4><strong>Email : </strong> <?php echo $prod['email'];?></h4>
		<h4><strong>Phone : </strong> <?php echo $prod['phone'];?></h4>
		
		
		</div>  
		</div>  
		<h4 style="text-align:center;clear:both;padding-top:20px; color:#fe980f;">Enter Bank Details</h4>
		<div class="col-sm-6 form-group"><label>Bank Name</label> <input readonly required type="text" name="bank_name" value="<?php if($this->input->post('bank_name')!='') { echo $this->input->post('bank_name'); }else { echo $prod['bank_name']; } ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>Branch</label> <input readonly required type="text" name="branch" value="<?php if($this->input->post('branch')!='') { echo $this->input->post('branch'); }else { echo $prod['branch']; } ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>State</label> <input readonly required type="text" name="bank_state" value="<?php if($this->input->post('bank_state')!='') { echo $this->input->post('bank_state'); }else { echo $prod['bank_state']; } ?>" class="form-control"></div>
		
		
		<div class="col-sm-6 form-group"><label>Account Type</label> <input readonly type="text" name="account_type" value="<?php if($this->input->post('account_type')!='') { echo $this->input->post('account_type'); }else { echo $prod['account_type']; } ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>Account Name</label> <input readonly type="text" name="account_name" value="<?php if($this->input->post('account_name')!='') { echo $this->input->post('account_name'); }else { echo $prod['account_name']; } ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>Account No.</label> <input readonly required type="number" name="account_no" value="<?php if($this->input->post('account_no')!='') { echo $this->input->post('account_no'); }else { echo $prod['account_no']; } ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>IFSC Code</label> <input readonly required type="text" name="ifsc" value="<?php if($this->input->post('ifsc')!='') { echo $this->input->post('ifsc'); }else { echo $prod['ifsc']; } ?>" class="form-control"></div>
		
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Approved Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  
			 <select name="status" class="form-control custom-select">
			  <option <?php if($prod['var_status'] == 'yes') { echo "checked"; } ?> value="yes">Approved</option>
			  <option <?php if($prod['var_status'] == 'no') { echo "checked"; } ?> value="no">Dispproved</option>
			  <option <?php if($prod['var_status'] == 'reject') { echo "checked"; } ?> value="reject">Reject</option>
			  </select>
          </div> 
          </div> 
		  
		  
		  
		    <div class="form-group col-sm-12">
            <label  class="control-label">Note</label>
              <textarea class="form-control" name="doc_note"><?php if($this->input->post('doc_note')!='') { echo $this->input->post('doc_note'); } ?></textarea>
          </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		
		</div> 
		
		</div>  

	</div>
				 
       
      <?php echo form_close(); ?>
	  

	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script>
  
 