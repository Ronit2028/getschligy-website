	
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
      echo form_open_multipart(base_url().'admin/quiz/add', $attributes);
	  ?>
      <div class="page-heading"> 
        <h2 class="iod">Enter Schlorship Questions<ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/quiz'; ?>">&laquo; Back</a><li><button type="reset" class="btn btn-primary btn-sm">Reset</button><li><button type="submit" class="btn btn-primary btn-sm">Save</button><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> URL added successfully.';
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
          <label  class="control-label col-sm-3">Enter Schlorship Name <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="name" value="<?php if($this->input->post('name')!='') { echo $this->input->post('name'); }  ?>" >
          </div>
          </div>
		 
		 
		 <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Enter total number of questions<small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="number" class="form-control" required name="total" value="<?php if($this->input->post('total')!='') { echo $this->input->post('total'); }  ?>" >
          </div>
          </div>
		 
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Enter marks on right answer<small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="number" class="form-control" required name="right" value="<?php if($this->input->post('right')!='') { echo $this->input->post('right'); }  ?>" >
          </div>
          </div>
		  
		
		 <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  <select name="status" class="form-control custom-select">
			  <option value="active">Active</option>
			  <option value="deactive">Deactive</option>
			  </select>
          </div> 
          </div> 

		
		  
		</div>  
		  
		 
<!-- prices-->	
<div class="col-sm-12">	 
				


	
	
	       <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/quiz'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	 