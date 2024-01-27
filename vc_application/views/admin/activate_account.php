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
        <h2>Activate User</h2>
      </div>
 <div  class="row">
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'activated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> PIN activated successfully.';
          echo '</div>';       
        }  elseif($this->session->flashdata('flash_message') == 'no_record'){
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>Active Record Not Found. Come Back Soon.';
          echo '</div>';          
        } elseif($this->session->flashdata('flash_message') == 'already'){
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>You Already Used Activated Your Account.';
          echo '</div>';          
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>PIN not activated please try again.';
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
      if(empty($user)) {
      echo form_open('admin/activate_account', $attributes);
      ?>
	  </div>
        <fieldset>
		   <div class="form-group col-sm-4">
            <label>Customer ID :</label>
              <input type="hidden" name="find_customer" value="yes" >
              <input type="text" class="form-control"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } else { echo $profile[0]['customer_id']; } ?>" >
          </div> 
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Activate Account</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); 
	  
	  } 
	  else {
		  echo form_open('admin/activate_account/'.$this->uri->segment(3), $attributes);
		  ?>
		 <div class="container">
		   <div class="form-group col-sm-4">
            <p><label>Customer: </label>&nbsp;<?php echo $user[0]['f_name'].' '.$user[0]['l_name'].' ('.$user[0]['customer_id'].')';?> 
              <input type="hidden" name="assign_to" value="<?php echo $user[0]['customer_id']; ?>" >
              <input type="hidden" name="pin" value="<?php $this->uri->segment(3); ?>" ></p>
			  <p><label>Wallet Balance: </label>&nbsp;INR <?php echo $user[0]['bliss_amount'];?></p>
			  
         <div class="form-group">
     <label>Product :</label>        
      
      <div class="form-group">
  <select  class="form-control" name="product" id="product" required>
  <option selected disabled>Select Product</option>
 
      <?php 
      if(!empty($product)) {
      foreach($product as $products){
            echo"<option product=".$products['p_d_price']." value=".$products['id']."~~".$products['p_d_price']."~~".$products['comm_dis']."~~".str_replace(' ', '-', $products['pname'])."~~".$products['t_class']."~~".$products['bv']."~~".$products['cost'].">".$products['pname']."   Amount:- ".$products['p_d_price']. " ( PV :- ".$products['comm_dis']. ")</option>";
        } 
      }
      
      
      ?>
      </select>
      </div>   
      </div>
          		
               </div> 
			
          
		  
		  <!--<p><label>package: </label>&nbsp;Rs 8000 
             </p>-->			  		  
		  
		  
		 
		   
		
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-success" type="submit">Activate Account</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>
          </div>
        </div>  
		  
	  <?php 
	  echo form_close(); 
	  } ?>
	</div>
  </div>
  </div>