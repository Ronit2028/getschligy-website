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
 
        <h2>Monthly Closing</h2>
      </div>
 <div class="container1">
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/weekly-closing');
      ?>
	  
	  	<div class="col-sm-12 hide">
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		  </div>
		  
	
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
</div> 
 <?php echo form_close(); ?>
 
<p>&nbsp;</p>
<?php echo $error_msg; ?>
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
      }
	  //print_r($restaurants);
      ?>
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      //echo form_open('admin/category/', $attributes);
      ?>
	  
<form method="post" action="" class="form form-inline">	  
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>S. No.</th><th>User ID</th><th>Name</th><th>Payout Amount </th><th>Bank Name</th><th>Bank A/c No</th><th>IFSC code</th><th>Pan Card No</th><!-- <th>Repurchase</th> --></tr> </thead> 
<tbody> 
<?php 
$i = 1;

/* echo "<pre>";
print_r($payouts);
echo "</pre>"; */
foreach($payouts as $con){ 
    
    $total_amount = $con['total_amount'];
	$g_total_amount = round((95/100)*$total_amount,2);
//if($con['total_order']+0>= 1000) { $repurchase = 'yes'; } else { $repurchase = 'no'; }
	echo '<tr><td>'.$i.'</td><td>'.$con['customer_id'].'</td><td>'.$con['f_name'].' '.$con['l_name'].'</td><td>Rs. '.$g_total_amount.'</td><td>'.$con['bank_name'].'</td>
	<td>'.$con['account_no'].'</td><td>'.$con['ifsc'].'</td><td>'.$con['pancard'].'</td>';
?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
 
<p class="text-center"><input type="submit" class="btn btn-primary" name="closeweek" value="Close This Monthly"> </p>
</form>

 <?php //echo form_close(); ?>