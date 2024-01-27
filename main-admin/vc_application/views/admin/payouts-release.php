<div class="page-heading">
 <h2>Redeem History</h2>
 </div>
	  <div class="col-sm-12">
	  <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-4">
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
    
  
  
	</div>   
	  <p>&nbsp;</p>
 
<div class="table-responsive col-sm-12">
<table id="example1" class="table table-bordered table-hover redeam-table"> 
	<thead> <tr><th>ID</th><th>Name</th><th>Cust. Id</th><th>Redeem</th><th>Status</th><th>Doc. ver.</th><th>Req. for</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
$total = 0;
foreach($redeam_apr as $con_apr){ 
	
	echo '<tr><td>'.$i.'</td><td>'.$con_apr['f_name'].'</td><td>'.$con_apr['customer_id'].'</td><td>'.$con_apr['redeem'].'</td><td>'.$con_apr['redeem_status'].'</td><td>'.$con_apr['var_status'].'</td><td>'.$con_apr['my_bliss_req'].'</td><td>'.$con_apr['releasedate'].'</td>';
echo '</tr>';
$i++;

 $total += $con_apr['redeem']; 

}


?>
</tbody> 
 <tfoot>
        <tr>
            <th scope="row">Totals</th>
			 <td colspan="2"></td>
            <td><b><?php echo $total; ?></b></td>
			<td colspan="5"></td>
        </tr>

</table></div>
</div>
 <?php echo form_close(); ?>