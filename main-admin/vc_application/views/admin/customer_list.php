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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Customers List</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> customer updated with success.';
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
      
      echo form_open('admin/customer/', $attributes);
      ?>
	  
	  
	  
	<div class="col-sm-12"> 
	    <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="date" class="form-control" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	  
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="date" class="form-control" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>

  </form>
  
  <div class="form-group col-sm-3"> 
		   <?php echo form_open(base_url().'index.php/vc_site_admin/customer/generatecsv'); ?> 
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div>
 
  
  
  
  
  
  
  
  
  
  </div>
  
	  <div class="col-sm-12">
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>ID</th> <th>Name</th><th>Email</th><!-- <th>Customer ID</th><th>Refferal ID</th> --><th>Phone</th><th>joining Date</th><!-- <th>Wallet</th><th>Shelf Wallet</th> --><th>status</th> <th></th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($customer as $con){ 
	if($con['consume'] >0) { $status = 'green';  } else  { $status = 'red';} 
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/customer/edit/'.$con['id'].'">'.$con['f_name'].'</a></td><td><a href="'.base_url().'admin/customer/edit/'.$con['id'].'">'.$con['email'].'</a></td><!-- <td>'.$con['customer_id'].'</td><td>'.$con['direct_customer_id'].'</td> --><td>'.$con['phone'].'</td><td>'.$con['rdate'].'</td><!-- <td>'.$con['bliss_amount'].'</td><td>'.round($con['shelf'],2).'</td> --><td>'.$con['status'].'</td>';
	
?>
<td><form method="post" action="<?php echo base_url(); ?>../index.php/vc_site_admin/user/super_admin_login" target="_blank" >
		  <input type="hidden"  required value="<?php echo $con['customer_id']; ?>" name="bcono" > 
		  <input type="submit" name="submit" class="btn btn-primary" value="Login">
	  	  <input type="hidden" name="auth" value="<?php echo md5('@#96pp~~'.md5('AdWinAdmin'));?>">
	 </form>
	</td>
	

		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</div>

 <?php echo form_close(); ?>