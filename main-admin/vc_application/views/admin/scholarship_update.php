	<style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 .iod ul{float:right}
	 .iods ul{float:right}
	 .iods{background:#ccc}
	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}
	 input[type="file"]{padding:0px;} 
	 
	 .print-div h4 {
	color: #ed5922;
}

.print-div p {
	margin: 0 0 10px;
	line-height: 32px;
}
span.and {
    width: 100%;
    margin: auto;
    text-align: center;
    display: flex;
    justify-content: center;
}
.col-md-10.col-md-offset-1.print-div.welcome-letter {
    background: #fff !important;
}
.text1 h3 {
	padding: 15px 0;
}
	 </style>
	 
	 <link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url(); ?>assets/css/print.css">
	 
	 <?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart('admin/scholarship/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $product[0];
	  ?>
      <div class="page-heading no-print"> 
        <h2 class="iod">Update scholarship <ul class="list-inline"><li>
		<a class="btn btn-primary flr" href="javascript:;" onclick="window.print();" style="margin:0px 5px; padding: 5px 10px;">Print</a>
		<a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/scholarship'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Updated successfully.';
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
        <fieldset> 
		
		<div id="collapse0" class="panel-collapse collapse in">
	  
			<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">First Name<small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $prod['f_name']; }  ?>" >
          </div>
          </div>
          
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Last Name</label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } else { echo $prod['l_name']; }  ?>" >
          </div>
          </div>
      <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Phone</label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $prod['phone']; }  ?>" >
          </div>
          </div>
          
		  
		 <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Email </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="email" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } else { echo $prod['email']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Pin code </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="pin_code" value="<?php if($this->input->post('pin_code')!='') { echo $this->input->post('pin_code'); } else { echo $prod['pin_code']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">State </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } else { echo $prod['state']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">City </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } else { echo $prod['city']; }  ?>" >
          </div>
          </div>
			<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Occupation </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="occupation" value="<?php if($this->input->post('occupation')!='') { echo $this->input->post('occupation'); } else { echo $prod['occupation']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Income </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="income" value="<?php if($this->input->post('income')!='') { echo $this->input->post('income'); } else { echo $prod['income']; }  ?>" >
          </div>
          </div>
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Category </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="category" value="<?php if($this->input->post('category')!='') { echo $this->input->post('category'); } else { echo $prod['category']; }  ?>" >
          </div>
          </div>
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Abled </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="abled" value="<?php if($this->input->post('abled')!='') { echo $this->input->post('abled'); } else { echo $prod['abled']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Orphan </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="orphan" value="<?php if($this->input->post('orphan')!='') { echo $this->input->post('orphan'); } else { echo $prod['orphan']; }  ?>" >
          </div>
          </div>
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">qualification </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="qualification" value="<?php if($this->input->post('qualification')!='') { echo $this->input->post('qualification'); } else { echo $prod['qualification']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Passing year </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="passing_year" value="<?php if($this->input->post('passing_year')!='') { echo $this->input->post('passing_year'); } else { echo $prod['passing_year']; }  ?>" >
          </div>
          </div>
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Grade </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="grade" value="<?php if($this->input->post('grade')!='') { echo $this->input->post('grade'); } else { echo $prod['grade']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Percentage </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="percentage" value="<?php if($this->input->post('percentage')!='') { echo $this->input->post('percentage'); } else { echo $prod['percentage']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Course </label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="course" value="<?php if($this->input->post('course')!='') { echo $this->input->post('course'); } else { echo $prod['course']; }  ?>" >
          </div>
          </div>
		
		  
		  
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status</label>
             <div class="col-sm-9">  <select name="status" class="form-control custom-select">
			  <option <?php if($prod['status']=='Under Process') { echo 'selected="selected"'; } ?> value="Under Process">Under Process</option>
			  <option <?php if($prod['status']=='Under Review') { echo 'selected="selected"'; } ?> value="Under Review">Under Review</option>
			  <option <?php if($prod['status']=='Under Verification') { echo 'selected="selected"'; } ?> value="Under Verification">Under Verification</option>
			  <option <?php if($prod['status']=='Disapproved') { echo 'selected="selected"'; } ?> value="Disapproved">Disapproved</option>
			  <option <?php if($prod['status']=='Approved') { echo 'selected="selected"'; } ?> value="Approved">Approved</option>
			  <option <?php if($prod['status']=='Pending') { echo 'selected="selected"'; } ?> value="Pending">Pending</option>
			  </select>
          </div> 
          </div> 
		 
		  
		  
		</div>  
		  
		 

				  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/scholarship'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	   <script>
	  jQuery(document).ready(function(){
		  var uid = 999;
		 jQuery('.add-attribute').click(function(){
            var add_attr = '<div class="remove-div-'+uid+'"><div class="form-group col-sm-5"><input placeholder="Title" type="text" required class="form-control" name="a_title[]" value="" ></div><div class="form-group col-sm-6"><input placeholder="Value" type="text" required class="form-control" name="a_value[]" value="" ></div><div class="col-sm-1"><button data=".remove-div-'+uid+'" type="button" class="remove-btn glyphicon glyphicon-remove remove-div"></button></div></div>';
			jQuery('.add-attribute-div').append(add_attr);
			uid++;
		 });
        jQuery('html').on('click','.remove-div',function(){
		  if(confirm('Are you sure ?')) {
           var cls = jQuery(this).attr('data');
		   jQuery(cls).html();
		   jQuery(cls).remove();
		 }
		});		
		
		var imgid = 999;
		 jQuery('.add-upload-img').click(function(){
            var add_attr = '<div class="remove-img-div-'+imgid+'"><div class="form-group col-sm-11"><input type="file" required class="form-control" name="p_image[]" value="" ></div><div class="col-sm-1"><button data=".remove-img-div-'+imgid+'" type="button" class="glyphicon glyphicon-remove remove-btn  remove-img-div"></button></div></div>';
			jQuery('.add-upload-img-div').append(add_attr);
			imgid++;
		 });
        jQuery('html').on('click','.remove-img-div',function(){
		  if(confirm('Are you sure ?')) { 
           var cls = jQuery(this).attr('data');
		   jQuery(cls).html();
		   jQuery(cls).remove();
		 }
		});	 
		
		jQuery('html').on('click','.remove-image-div',function(){
		  if(confirm('Are you sure ?')) {
           var img = jQuery(this).attr('data-img');
		   jQuery.ajax({
			   type:"POST",
			   url:"<?php echo base_url();?>admin/product/remove_img",
			   data:"img="+img,
			   success:function(data){}
		   });
           var cls = jQuery(this).attr('data');
		   jQuery(cls).html();
		   jQuery(cls).remove();
		 }
		});	
	  
	  jQuery('.show-attributes').click(function(){
		  jQuery('.panel-collapse').removeClass('in');
		  jQuery('#collapse4').addClass('in');
	  });
	  });
	  </script>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script>
  
 