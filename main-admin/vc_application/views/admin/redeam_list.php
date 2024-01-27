<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
<div class="page-heading">
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/redeam/add'; ?>">Add New</a--> 
        <h2>Redeem Request </h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> redeam updated with success.';
          echo '</div>';       
        }else{
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
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/redeam/', $attributes);
      ?>
	  
	  
	  
	  
	  
	  <div class="col-sm-12"> 
      <form class="form form-inline" method="post" action="">
     
   
 
      
   
	  
	  
	 </form>
  
   <div class="form-group col-sm-3"> 
		   <?php echo form_open(base_url().'index.php/vc_site_admin/redeam/generatecsv'); ?> 
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	<label>&nbsp;</label>
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div>
  
  
   
   </div>    
	  <p>&nbsp;</p> 
	
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover redeam-table"> 
	<thead> <tr><th>ID</th><th>Name</th><th>Email</th><th>Redeem</th><th>Cust. Id</th><th>Status</th><th>Doc. ver.</th><th>Req. for</th><th>Date</th><th></th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($redeam as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/redeam/edit/'.$con['rd_id'].'">'.$con['f_name'].'</a></td><td><a href="'.base_url().'admin/redeam/edit/'.$con['rd_id'].'">'.$con['email'].'</a></td><td>'.$con['redeem'].'</td><td>'.$con['customer_id'].'</td><td>'.$con['redeem_status'].'</td><td>'.$con['var_status'].'</td><td>'.$con['my_bliss_req'].'</td><td>'.$con['rdate'].'</td>';
 if($con['redeem_status'] =='pending') {
    echo '<td><input type="checkbox" name="id[]" value="'.$con['rd_id'].'" ></td>';
 } 
echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>

<div class="container">
  <div class="row">
      <div class="col-md-4 form-group">
        <label>Status</label>
        <select class="form-control" name="status">
          <option value="approved">Approved</option>
          <option value="cancel">Cancel</option>
        </select>
      </div>
    
    <div class="col-md-4 form-group">
        
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        
      </div>
  </div>
</div>

 <?php echo form_close(); ?>