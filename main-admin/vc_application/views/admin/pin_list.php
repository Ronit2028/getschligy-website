<div class="page-heading">
        <h2>Startup</h2>
</div>
	  
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> pin updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
		
		if($distributeall == 'done') {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> Amount distribution successfully.';
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
      
      echo form_open();
      ?>
	  
	  <div class="col-sm-12">
	   <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	  
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
		  </form>
			  <div class="form-group col-sm-3">
		  
		  </div>

  
  </div>
 <?php echo form_close(); ?>
 
<p>&nbsp;</p>


 
	  <div class="table-responsive">
	  <?php
      echo validation_errors();
      echo form_open('admin/pin/used');
      ?>
<table id="example" class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>Sr. No.</th><th>Date </th><th>order Id </th><th>Amount</th><th>User id</th><th>User Name</th><th>Status</th> </tr> </thead> <tbody> 
<?php 
$i = 1;
$bv=0;
foreach($pin as $con){ 
$bv=$bv+$con['comm_dis'];
	
	echo '<tr><td>'.$i.'</td><td>'.$con['o_date'].'</td><td>'.$con['id'].'</td><td>'.$con['total_amount'].'</td><td>'.$con['customer_id'].'</td><td>'.$con['f_name'].'</td><td>'.$con['status'].'</td>';
?>

		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
<tfoot>
<tr>
<th colspan='3'>Total Amount Excluding GST</th>
<th><?php echo $bv;?></th>

<th colspan='2'>Distribution amount <?php echo $bv*(4 / 100);?></th>
<th colspan='3'><input type="submit" name="destribute" class="btn btn-primary" value="Distribute amount"></th>

</tr>
</tfoot>

</table>
<input type="hidden" name="dis_amt" value="<?php echo $bv ;?>">
<?php echo form_close(); ?>

</div>
